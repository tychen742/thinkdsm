import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            first_line = source[0] if source else ''
        else:
            first_line = source.split('\n')[0] if source else ''
        if 'EXERCISE' in first_line:
            tags = cell.get('metadata', {}).get('tags', [])
            print(f'Cell {i}: EXERCISE')
            print(f'  Tags: {tags}')
            # Check next cell
            if i+1 < len(nb['cells']):
                next_cell = nb['cells'][i+1]
                next_tags = next_cell.get('metadata', {}).get('tags', [])
                print(f'Cell {i+1}: Solution cell')
                print(f'  Tags: {next_tags}')
            print()
