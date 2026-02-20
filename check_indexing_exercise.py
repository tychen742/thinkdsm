import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source = ''.join(source)
        
        if 'EXERCISE: DataFrame Indexing Practice' in source:
            print(f'Found at cell {i}')
            print(f'Content preview:')
            print(source[:500])
            print('\n\nPrevious cell (cell {i-1}):')
            prev_source = nb['cells'][i-1].get('source', [])
            if isinstance(prev_source, list):
                prev_source = ''.join(prev_source)
            print(prev_source[:300])
            print('\n\nNext few cells:')
            for j in range(i+1, min(i+3, len(nb['cells']))):
                next_source = nb['cells'][j].get('source', [])
                if isinstance(next_source, list):
                    next_source = ''.join(next_source)
                print(f'\nCell {j}: {next_source[:200]}')
