import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source = ''.join(source)
        
        if 'EXERCISE: Exploring DataFrame Attributes' in source:
            print(f'Cell {i}: EXERCISE: Exploring DataFrame Attributes')
            print(f'  Metadata: {cell.get("metadata", {})}')
            print(f'  Tags: {cell.get("metadata", {}).get("tags", [])}')
            
            # Check next cell (solution)
            if i+1 < len(nb['cells']):
                next_cell = nb['cells'][i+1]
                print(f'\nCell {i+1}: Solution')
                print(f'  Metadata: {next_cell.get("metadata", {})}')
                print(f'  Tags: {next_cell.get("metadata", {}).get("tags", [])}')
