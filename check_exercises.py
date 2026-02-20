import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    current_section_2 = None
    exercises_found = []
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source = ''.join(source)
        
        # Check for ## headers
        if cell['cell_type'] == 'markdown':
            lines = source.split('\n')
            for line in lines:
                if line.startswith('## ') and not line.startswith('###'):
                    if exercises_found and current_section_2:
                        print(f'  Exercises: {exercises_found}')
                    current_section_2 = line.strip('# ').strip()
                    exercises_found = []
                    print(f'\n## {current_section_2}')
                elif line.startswith('### ') and not line.startswith('####'):
                    if 'EXERCISE' in line:
                        exercise_name = line.strip('# ').strip()
                        exercises_found.append(exercise_name)
    
    if exercises_found and current_section_2:
        print(f'  Exercises: {exercises_found}')
