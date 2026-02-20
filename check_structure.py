import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    current_section_2 = None
    current_section_3 = None
    
    for i, cell in enumerate(nb['cells']):
        if cell['cell_type'] == 'markdown':
            source = cell.get('source', [])
            if isinstance(source, list):
                source = ''.join(source)
            
            lines = source.split('\n')
            for line in lines:
                # Check for ## headers
                if line.startswith('## ') and not line.startswith('###'):
                    current_section_2 = line.strip('# ').strip()
                    current_section_3 = None
                    print(f'\n## {current_section_2}')
                
                # Check for ### headers (but not #### or code comments)
                elif line.startswith('### ') and not line.startswith('####'):
                    # Skip EXERCISE headers as they're not section headers
                    if 'EXERCISE' not in line and 'Your code' not in line:
                        # Skip code comment-style headers
                        if not any(skip in line for skip in ['Get ', 'Create ', 'Pass ', 'Use ', 'BETTER', 'Combine', 'Each', 'Recreate', 'The to_string()', 'commented out']):
                            current_section_3 = line.strip('# ').strip()
                            print(f'  ### {current_section_3}')
