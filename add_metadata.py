import json

# Read the notebook
with open('/Users/tychen/workspace/dsm/chapters/04-pandas/0403-pd-dataframe.ipynb', 'r') as f:
    nb = json.load(f)

# Find and update the cells that need metadata
cells_to_update = []
for i, cell in enumerate(nb['cells']):
    source = ''.join(cell.get('source', []))
    if '### EXERCISE: Creating a DataFrame from Scratch' in source:
        cells_to_update.append((i, 'Creating a DataFrame from Scratch'))
        if 'metadata' not in cell:
            cell['metadata'] = {}
        if 'tags' not in cell['metadata']:
            cell['metadata']['tags'] = []
        if 'thebe-interactive' not in cell['metadata']['tags']:
            cell['metadata']['tags'].append('thebe-interactive')
    elif '### EXERCISE: Working with Duplicates' in source:
        cells_to_update.append((i, 'Working with Duplicates'))
        if 'metadata' not in cell:
            cell['metadata'] = {}
        if 'tags' not in cell['metadata']:
            cell['metadata']['tags'] = []
        if 'thebe-interactive' not in cell['metadata']['tags']:
            cell['metadata']['tags'].append('thebe-interactive')

# Write the updated notebook
with open('/Users/tychen/workspace/dsm/chapters/04-pandas/0403-pd-dataframe.ipynb', 'w') as f:
    json.dump(nb, f, indent=1)

print(f'Updated {len(cells_to_update)} cells:')
for idx, title in cells_to_update:
    print(f'  - Cell {idx}: {title}')
