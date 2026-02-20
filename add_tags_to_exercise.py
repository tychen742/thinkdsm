import json

# Read the notebook
with open('chapters/04-pandas/0403-pd-dataframe.ipynb', 'r') as f:
    nb = json.load(f)

# Find the cells and add tags
for i, cell in enumerate(nb['cells']):
    source = cell.get('source', [])
    if isinstance(source, list):
        source_text = ''.join(source)
    else:
        source_text = source
    
    # Find the exercise cell
    if 'EXERCISE: Exploring DataFrame Attributes' in source_text and cell['cell_type'] == 'code':
        print(f'Found exercise at cell {i}, adding thebe-interactive tag')
        if 'metadata' not in cell:
            cell['metadata'] = {}
        if 'tags' not in cell['metadata']:
            cell['metadata']['tags'] = []
        if 'thebe-interactive' not in cell['metadata']['tags']:
            cell['metadata']['tags'].append('thebe-interactive')
        
        # Check if next cell is the solution
        if i+1 < len(nb['cells']):
            next_cell = nb['cells'][i+1]
            next_source = next_cell.get('source', [])
            if isinstance(next_source, list):
                next_source_text = ''.join(next_source)
            else:
                next_source_text = next_source
            
            if '# Solution' in next_source_text or 'df_actors' in next_source_text:
                print(f'Found solution at cell {i+1}, adding hide-input tag')
                if 'metadata' not in next_cell:
                    next_cell['metadata'] = {}
                if 'tags' not in next_cell['metadata']:
                    next_cell['metadata']['tags'] = []
                if 'hide-input' not in next_cell['metadata']['tags']:
                    next_cell['metadata']['tags'].append('hide-input')

# Write back
with open('chapters/04-pandas/0403-pd-dataframe.ipynb', 'w') as f:
    json.dump(nb, f, indent=1)

print('Tags added successfully!')
