import json

# Read the notebook
with open('chapters/04-pandas/0403-pd-dataframe.ipynb', 'r') as f:
    nb = json.load(f)

# Find the exercise and solution cells
for i, cell in enumerate(nb['cells']):
    source = ''.join(cell.get('source', []))
    
    # Exercise cell - add thebe-interactive tag
    if 'EXERCISE: DataFrame Selection and Indexing' in source:
        if 'metadata' not in cell:
            cell['metadata'] = {}
        if 'tags' not in cell['metadata']:
            cell['metadata']['tags'] = []
        if 'thebe-interactive' not in cell['metadata']['tags']:
            cell['metadata']['tags'].append('thebe-interactive')
        print(f'Added thebe-interactive tag to exercise cell {i}')
        
        # Solution cell is the next one
        if i + 1 < len(nb['cells']):
            solution_cell = nb['cells'][i + 1]
            if 'metadata' not in solution_cell:
                solution_cell['metadata'] = {}
            if 'tags' not in solution_cell['metadata']:
                solution_cell['metadata']['tags'] = []
            if 'hide-input' not in solution_cell['metadata']['tags']:
                solution_cell['metadata']['tags'].append('hide-input')
            print(f'Added hide-input tag to solution cell {i+1}')
        break

# Write back
with open('chapters/04-pandas/0403-pd-dataframe.ipynb', 'w') as f:
    json.dump(nb, f, indent=1)
    
print('Tags added successfully!')
