import time
import sys
import os
import csv
import re
from otter.api import grade_submission

# --- Tab completion setup ---
# adding readline for tab completion so i can just press tab to autocomplete paths
# makes it way easier than typing full paths every time
try:
    import readline
    import glob

    def path_completer(text, state):
        # this function handles the tab completion
        # when i press tab it shows me available files/folders
        # adding */ to show directories and * for any file
        line = readline.get_line_buffer()

        # if nothing typed yet, show current directory contents
        if not text:
            completions = glob.glob('*')
        else:
            # otherwise show matches for what i typed
            completions = glob.glob(text + '*')

        # adding / to directories so i know they're folders
        completions = [f + '/' if os.path.isdir(f) else f for f in completions]

        # readline calls this multiple times with different state values
        # to get all possible completions
        return completions[state] if state < len(completions) else None

    # set up the completer
    readline.set_completer(path_completer)
    readline.parse_and_bind('tab: complete')

    # on mac the default is different so setting it explicitly
    if 'libedit' in readline.__doc__:
        readline.parse_and_bind("bind ^I rl_complete")

    print("Tab completion enabled! Press Tab to autocomplete file/folder names.")

except ImportError:
    # windows doesnt have readline by default
    # still works but no tab completion
    print("Note: Tab completion not available (readline module not found)")
    print("Install pyreadline3 on Windows for tab completion: pip install pyreadline3")

print()

# --- Config stuff ---
# changed from hardcoded values to user input so i can reuse this script for different assignments
# also easier than editing the code every time

submissions_dir = input("Enter submissions folder path (default: submissions): ").strip() or "submissions"
autograder_path = input("Enter autograder zip file path (default: autograder.zip): ").strip() or "autograder.zip"
canvas_csv_path = input("Enter Canvas CSV file path: ").strip()
assignment_name = input("Enter assignment name from Canvas (e.g., 'Midterm Exam'): ").strip()

# keeping these fixed because no reason to change them every time
csv_filename = "detailed_grading_results.csv"
individual_results_dir = "individual_results"

# makes the folder if it doesn't exist yet
os.makedirs(individual_results_dir, exist_ok=True)

# --- NEW: Validate Canvas CSV and assignment name BEFORE grading ---
# now if theres an issue i can fix it before wasting time grading all the notebooks
print("\n--- Validating Canvas CSV ---\n")

try:
    # read the canvas file first
    # canvas exports are weird with encoding, sometimes they use windows-1252 or latin-1
    # so trying multiple encodings until one works
    # this was driving me crazy until i figured out the encoding issue

    canvas_data = None
    encodings_to_try = ['utf-8-sig', 'utf-8', 'cp1252', 'latin-1', 'iso-8859-1']

    for encoding in encodings_to_try:
        try:
            with open(canvas_csv_path, "r", encoding=encoding, newline="") as f:
                # IMPORTANT: canvas uses semicolon delimiter not comma!
                # took me forever to figure out why my first version wasnt working
                reader = csv.reader(f, delimiter=";")
                canvas_data = list(reader)
            print(f"✓ Successfully read Canvas CSV using {encoding} encoding")
            break
        except UnicodeDecodeError:
            # this encoding didnt work, try next one
            continue

    if canvas_data is None:
        print("ERROR: Could not read Canvas CSV with any standard encoding")
        sys.exit(1)

    # finding which column has the assignment i want to update
    # header row is first row (index 0)
    header_row = canvas_data[0]

    # loop until we find the right assignment name
    # this way if i type it wrong i can just try again instead of rerunning the whole script
    assignment_col_idx = None

    while assignment_col_idx is None:
        print(f"\nLooking for assignment: '{assignment_name}'")

        # finding the assignment column by searching for assignment name in header
        # canvas format is like "Midterm Exam (3337622)" so i need to extract just "Midterm Exam"
        # and do exact match, otherwise "Midterm Exam" would also match "Midterm Exam 2"
        for idx, col_name in enumerate(header_row):
            # extract the assignment name part (before the parentheses)
            # example: "Midterm Exam (3337622)" -> "Midterm Exam"
            if "(" in col_name:
                canvas_assignment_name = col_name.split("(")[0].strip()
            else:
                canvas_assignment_name = col_name.strip()

            # now do exact match (case insensitive)
            if canvas_assignment_name.lower() == assignment_name.lower():
                assignment_col_idx = idx
                print(f"✓ Found assignment: {col_name} (column {idx})")
                break

        # if we didnt find it, show all available assignments and let user try again
        if assignment_col_idx is None:
            print(f"\n✗ ERROR: Could not find assignment '{assignment_name}' in Canvas CSV!")
            print("\nAvailable assignments:\n")

            # showing assignment columns starting from index 4 (after Student, ID, SIS Login, Section)
            # limiting to reasonable number so it doesnt spam too much
            for idx in range(4, min(len(header_row), 60)):
                col = header_row[idx]
                # extract just the assignment name for easier reading
                if "(" in col:
                    display_name = col.split("(")[0].strip()
                else:
                    display_name = col
                print(f"  [{idx}] {display_name}")

            print("\n💡 TIP: Copy the EXACT name from above (without the number in parentheses)")

            # ask user to enter the correct name
            # they can also just ctrl+c to quit if they want
            assignment_name = input("\nEnter the correct assignment name (or Ctrl+C to quit): ").strip()

            if not assignment_name:
                print("ERROR: Assignment name cannot be empty")
                sys.exit(1)

    print(f"\n✓ Canvas CSV validated successfully!\n")

except FileNotFoundError:
    print(f"ERROR: Canvas CSV file not found at: {canvas_csv_path}")
    print("Make sure you typed the path correctly!")
    sys.exit(1)
except KeyboardInterrupt:
    print("\n\nCancelled by user")
    sys.exit(0)
except Exception as e:
    print(f"ERROR validating Canvas CSV: {e}")
    sys.exit(1)

# ID column is always second column (index 1) in canvas csv format
id_col_idx = 1

# list to hold everyone's grades before writing to csv
all_grades = []

# set to store all the unique column headers found across notebooks
all_column_headers = set()

# dictionary to store student_id -> total_score mapping for canvas update
# basically i need to match student ids with their scores later when updating canvas file
student_scores = {}

print("--- Starting Grading Process ---\n")

# 1. Loop through every file in the submissions folder
for filename in os.listdir(submissions_dir):
    # only care about ipynb files obviously
    if filename.endswith(".ipynb"):
        submission_path = os.path.join(submissions_dir, filename)
        print(f"Grading {filename}...", end=" ")

        # extract student ID from filename
        # canvas downloads have pattern: lastname_STUDENTID_numbers_filename.ipynb
        # so i'm splitting by underscore and grabbing second part
        try:
            parts = filename.split("_")
            # student id should be second field after splitting by underscore
            student_id = parts[1] if len(parts) > 1 else None

            # quick check to make sure its actually a number and not something weird
            # sometimes filenames dont follow the pattern exactly
            if student_id and not student_id.isdigit():
                student_id = None
                print(f"WARNING: Could not extract student ID from {filename}", end=" ")
        except:
            # if anything breaks during parsing just set to None and warn
            student_id = None
            print(f"WARNING: Could not parse filename {filename}", end=" ")

        try:
            # this runs the actual grading.
            # honestly i tried doing this with a shell command inside python using os.system
            # but getting the output parsed was a nightmare so using the api is way better
            result = grade_submission(submission_path, autograder_path)

            # grabbing the easy stuff first
            row = {
                "submission": filename,
                "student_id": student_id if student_id else "NOT_FOUND",
                "total_score": result.total,
                "possible": result.possible,
                "percentage": result.percent * 100
            }

            # storing the score for canvas update later
            # if no student id found, cant match it in canvas so just skip
            if student_id:
                student_scores[student_id] = result.total

            # 2. Get the score for each individual question
            # i originally tried just accessing result['results'] but that threw a TypeError
            # because result is an object, not a dict. so checking hasattr just in case.
            if hasattr(result, "results"):
                for question_key, test_result in result.results.items():
                    # test_result has .score and .possible inside it.
                    # creating a formatted header that includes the max score like "Q1 (5.0)"
                    header_name = f"{question_key} ({test_result.possible})"
                    # storing the score under this new fancy header name
                    row[header_name] = test_result.score
                    # gotta add this key to the master list so we know what columns to make in the csv
                    all_column_headers.add(header_name)

            all_grades.append(row)
            print(f"Done. Score: {result.total}/{result.possible}")

            # --- Making individual text files for each student ---
            # removing the .ipynb extension so the filename looks cleaner
            student_name = filename.replace(".ipynb", "")
            text_filename = os.path.join(individual_results_dir, f"{student_name}_results.txt")

            # okay so i wanted this to look like the output from "otter run" command
            # spent way too long trying to capture stdout from subprocess but it was a mess
            # so just manually formatting it to look similar
            with open(text_filename, "w") as f:
                # the header with equal signs to make it look official
                f.write("=" * 80 + "\n")
                f.write(" " * 25 + "GRADING SUMMARY\n")
                f.write("=" * 80 + "\n\n")
                # basic info at the top
                f.write(f"Student: {filename}\n")
                # adding student id here so i can easily see who's who
                f.write(f"Student ID: {student_id if student_id else 'NOT FOUND'}\n\n")
                f.write(f"Total Score: {result.total:.3f} / {result.possible:.3f} ({result.percent * 100:.3f}%)\n\n")

                # table with all the question breakdowns
                # tried using tabs at first but they looked inconsistent so switched to fixed width formatting
                if hasattr(result, "results"):
                    # header row for the table
                    f.write(f"{'#':<5} {'name':<20} {'score':<10} {'max_score':<10}\n")
                    f.write("-" * 50 + "\n")
                    # enumerate gives us the index which matches the otter output format
                    for idx, (question_key, test_result) in enumerate(result.results.items()):
                        # handling None scores because some students had weird notebooks that broke
                        score_str = f"{test_result.score}" if test_result.score is not None else "0.0"
                        max_score_str = f"{test_result.possible}"
                        f.write(f"{idx:<5} {question_key:<20} {score_str:<10} {max_score_str:<10}\n")

                # footer with timestamp so i know when i ran this
                f.write("\n" + "=" * 80 + "\n")
                f.write(f"Results saved on: {time.strftime('%Y-%m-%d %H:%M:%S')}\n")

            # extra confirmation message so i can see it's actually creating the files
            print(f"   → Individual results saved to {text_filename}")

        except Exception as e:
            # if a notebook is broken or corrupt, just print the error and keep going
            # otherwise the whole script crashes which is annoying
            print(f"ERROR: Failed to grade {filename}. Reason: {e}")
            all_grades.append({
                "submission": filename,
                "student_id": student_id if student_id else "NOT_FOUND",
                "total_score": "ERROR",
                "possible": 0,
                "percentage": 0
            })

            # still making a text file for error cases so students know something went wrong
            student_name = filename.replace(".ipynb", "")
            text_filename = os.path.join(individual_results_dir, f"{student_name}_results.txt")
            with open(text_filename, "w") as f:
                f.write("=" * 80 + "\n")
                f.write(" " * 25 + "GRADING SUMMARY\n")
                f.write("=" * 80 + "\n\n")
                f.write(f"Student: {filename}\n")
                f.write(f"Student ID: {student_id if student_id else 'NOT FOUND'}\n\n")
                f.write(f"ERROR: Failed to grade this submission\n")
                f.write(f"Reason: {e}\n")

# 3. Sort the question names
# if i don't sort this, the columns in the csv come out in random order which looks messy
# since the headers start with the question name (e.g. "Q1..."), sorting still works fine
sorted_column_headers = sorted(list(all_column_headers))

# 4. Set up the csv headers
# combining the standard info columns with the dynamic question columns we found
# added student_id column so i can cross-reference with canvas easier
fieldnames = ["submission", "student_id", "total_score", "possible", "percentage"] + sorted_column_headers

print(f"\nWriting results to {csv_filename}...")

# 5. Actually write the detailed grading file
# used newline="" because otherwise i was getting blank rows between every student in windows
with open(csv_filename, "w", newline="") as csvfile:
    writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
    writer.writeheader()
    for row in all_grades:
        # DictWriter is nice because if a student is missing a specific question key
        # (like if they deleted a cell), it just leaves that cell blank instead of crashing
        writer.writerow(row)

print(f"CSV saved to: {csv_filename}")

# --- Updating Canvas CSV file ---
# this part updates the canvas gradebook with the scores i just calculated
# since we already validated the assignment earlier, this should just work
print(f"\n--- Updating Canvas CSV File ---\n")

# asking user if they want a new file or to overwrite existing
write_new_file = input("Write a new Canvas file? (yes/no): ").strip().lower()

# figuring out which file to write to based on their answer
if write_new_file == "yes":
    output_canvas_file = "updated_canvas_grades.csv"
else:
    output_canvas_file = canvas_csv_path

try:
    # now update the scores for each student
    # canvas csv structure:
    # row 0 = headers (Student, ID, SIS Login, Section, assignments...)
    # row 1 = manual posting flags
    # row 2 = points possible
    # row 3+ = actual student data
    # so starting from row 3

    updated_count = 0
    not_found_count = 0

    for row_idx in range(3, len(canvas_data)):
        row = canvas_data[row_idx]

        # get student id from canvas row
        # making sure row is long enough first to avoid index errors
        if len(row) <= id_col_idx:
            continue

        canvas_student_id = row[id_col_idx].strip()

        # check if i have a score for this student from the grading above
        if canvas_student_id in student_scores:
            # update the score in assignment column
            # extending row if needed because some students might have incomplete data
            while len(row) <= assignment_col_idx:
                row.append("")

            # setting the score from my grading results
            row[assignment_col_idx] = str(student_scores[canvas_student_id])
            updated_count += 1
            print(f"Updated student ID {canvas_student_id}: {student_scores[canvas_student_id]} points")
        else:
            # student in canvas but not in my graded submissions
            # not setting to 0 automatically because maybe they didnt submit yet
            # or maybe i didnt download their file properly
            not_found_count += 1
            print(f"Student ID {canvas_student_id} not found in graded submissions")

    # write updated canvas csv to chosen file
    # using semicolon delimiter same as original canvas format
    with open(output_canvas_file, "w", encoding="utf-8", newline="") as f:
        writer = csv.writer(f, delimiter=";")
        writer.writerows(canvas_data)

    print(f"\nCanvas CSV updated successfully!")
    print(f"Updated {updated_count} student scores")
    print(f"{not_found_count} students in Canvas but not in graded submissions")
    print(f"Updated file saved as: {output_canvas_file}")

except Exception as e:
    print(f"ERROR updating Canvas CSV: {e}")

# --- FLASHING EFFECT ---
# Using standard sys library to overwrite the line, making it blink
# This loop runs 5 times to create a flashing effect
print("\n")
msg = "✨ GRADING COMPLETE ✨"
empty = " " * len(msg)

try:
    for _ in range(5):
        # \r moves the cursor back to the start of the line so we can overwrite it
        sys.stdout.write(f"\r{msg}")
        sys.stdout.flush()
        time.sleep(0.5)  # wait half a second
        # overwrite with empty spaces to make it "disappear"
        sys.stdout.write(f"\r{empty}")
        sys.stdout.flush()
        time.sleep(0.5)
    # Leave the message visible at the end so they know it's actually done
    sys.stdout.write(f"\r{msg}\n")
except KeyboardInterrupt:
    # just in case someone hits ctrl+c during the flash, don't crash
    pass

print(f"\nAll results saved:")
print(f"  - Detailed CSV: {csv_filename}")
print(f"  - Individual results: {individual_results_dir}/")
print(f"  - Updated Canvas file: {output_canvas_file}")
print(f"\nYou can now import {output_canvas_file} into Canvas!")
