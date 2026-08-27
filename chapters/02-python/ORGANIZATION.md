# Chapter 02 Organization

## Chapter Role

Chapter 02 teaches the Python fundamentals students need before working with NumPy, pandas, visualization, and statistical simulations. The emphasis is practical fluency for data science and management tasks rather than software engineering depth.

## Learning Goals

Students should be able to:

1. Write and run simple Python statements using correct syntax.
2. Use variables, objects, types, and operators to represent and transform values.
3. Use conditional statements to express business rules and decision logic.
4. Use `while` and `for` loops to repeat work over counts, conditions, and collections.
5. Create, index, slice, modify, and iterate over lists.
6. Use dictionaries to map keys to values and count repeated items.
7. Define and call functions with parameters, return values, and docstrings.
8. Interpret basic Python errors and stack traces.

## Sequence

1. `0200-intro-py.ipynb` - Python Basics
   - Chapter orientation
   - Python cheat sheet figure
2. `0201-py-syntax.ipynb` - Python Syntax
   - Input and output
   - Comments
   - Variables, objects, and type conversion
   - Keywords and operators
   - Built-in data types
   - Data structures
   - Modules and packages
3. `0202-control-structures.ipynb` - Control Structures
   - Conditional statements
   - Boolean expressions and logical operators
   - `while` loops
   - `for` loops
   - Looping through sequences
   - `range()`, `enumerate()`, nested loops, and loop control
4. `0203-lists.ipynb` - Lists
   - Basic list operations
   - List functions and methods
   - Lists and strings
   - Objects, values, and aliasing
   - Word-list file examples
5. `0206-dictionaries.ipynb` - Dictionaries
   - Dictionaries as mappings
   - Creating and querying dictionaries
   - Counters and accumulation patterns
   - Lists and dictionaries
6. `0208-functions.ipynb` - Functions
   - Built-in functions
   - Defining and calling functions
   - Parameters and arguments
   - Composition, return values, and docstrings
   - Scope, stack diagrams, and tracebacks
7. `assignments/index.ipynb` - Assignments
   - Preview
   - Lab
   - Homework

## Unlisted Material

- `0204-tuples.ipynb` is present in the chapter folder but not listed in `_toc.yml`. Treat it as dormant material until the chapter sequence is intentionally revised.

## Exercise And Assignment Plan

- Preview: primes students on Chapter 02 Python terminology and basic mechanics.
- Lab: should provide applied practice with syntax, control flow, lists, dictionaries, and functions.
- Homework: should reinforce section-level skills and prepare students for NumPy in Chapter 03.

## Deferred Work

- Move `diagram.py` and `words.txt` out of `chapters/02-python/` into `materials/02/`, then update and test affected notebooks.
- Decide whether tuple material belongs in the live Chapter 02 sequence, another chapter, or an archive.
- Create or restore `_html_extra/chapters/02-python/overview.md` and rendered `overview.html` if Chapter 02 should have overview slides matching the current landing-page rule.
- Review whether Chapter 02 section notebooks have the expected exercise coverage for substantial `###` sections.
