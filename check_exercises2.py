import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    current_section_2 = None
    exercises_in_section = []
    last_subsection_3 = None
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source = ''.join(source)
        
        # Track section transitions
        if cell['cell_type'] == 'markdown':
            lines = source.split('\n')
            for line in lines:
                if line.startswith('## ') and not line.startswith('###'):
                    # Print previous section's exercises before moving to new section
                    if current_section_2:
                        if exercises_in_section:
                            print(f'  Exercises: {len(exercises_in_section)} - {exercises_in_section}')
                        else:
                            print(f'  Exercises: NONE')
                    
                    current_section_2 = line.strip('# ').strip()
                    exercises_in_section = []
                    last_subsection_3 = None
                    print(f'\n## {current_section_2}')
                    
                elif line.startswith('### ') and not line.startswith('####'):
                    last_subsection_3 = line.strip('# ').strip()
        
        # Check for EXERCISE in any cell (code or markdown)
        if 'EXERCISE' in source and '### EXERCISE' in source:
            exercise_lines = [line for line in source.split('\n') if '### EXERCISE' in line]
            for ex_line in exercise_lines:
                exercise_name = ex_line.strip('# ').strip()
                exercises_in_section.append(exercise_name)
    
    # Print last section
    if current_section_2:
        if exercises_in_section:
            print(f'  Exercises: {len(exercises_in_section)} - {exercises_in_section}')
        else:
            print(f'  Exercises: NONE')
