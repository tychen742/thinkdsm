import json

# Read the notebook
with open('chapters/04-pandas/0401-pd-series.ipynb', 'r') as f:
    nb = json.load(f)

# Track changes
changes = []

# Add metadata to exercise cells
for i, cell in enumerate(nb['cells']):
    if cell['cell_type'] == 'code':
        source = ''.join(cell['source'])
        
        # Check if it's an exercise cell
        if '### EXERCISE:' in source:
            cell['metadata'] = {
                'editable': True,
                'slideshow': {'slide_type': ''},
                'tags': ['thebe-interactive']
            }
            changes.append(f'Cell {i}: Added thebe-interactive tag (exercise)')
            
        # Check if it's a solution cell (starts with "# Solution")
        elif source.strip().startswith('# Solution'):
            cell['metadata'] = {
                'editable': True,
                'slideshow': {'slide_type': ''},
                'tags': ['hide-input']
            }
            changes.append(f'Cell {i}: Added hide-input tag (solution)')

# Write back
with open('chapters/04-pandas/0401-pd-series.ipynb', 'w') as f:
    json.dump(nb, f, indent=1)

print(f'Modified {len(changes)} cells:')
for change in changes:
    print(f'  {change}')
