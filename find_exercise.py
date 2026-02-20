import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source_text = ''.join(source)
        else:
            source_text = source
        
        if 'EXERCISE' in source_text and 'Exploring' in source_text:
            tags = cell.get('metadata', {}).get('tags', [])
            print(f'Cell {i}: Exploring DataFrame exercise')
            print(f'  Tags: {tags}')
            print(f'  Metadata: {cell.get("metadata", {})}')
        elif 'df_actors' in source_text and 'print' in source_text:
            tags = cell.get('metadata', {}).get('tags', [])
            print(f'Cell {i}: df_actors solution')
            print(f'  Tags: {tags}')
            print(f'  Metadata: {cell.get("metadata", {})}')
