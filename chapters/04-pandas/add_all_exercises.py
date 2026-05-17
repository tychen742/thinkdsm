import json

# Read the notebook
with open('0403-pd-dataframe.ipynb', 'r') as f:
    nb = json.load(f)

# Helper function to find cell index by ID
def find_cell_by_id(cells, cell_id):
    for i, cell in enumerate(cells):
        if cell.get('id') == cell_id:
            return i
    return None

# Define all exercises with proper format

exercises_to_add = [
    {
        'after_id': '#VSC-edfbdc93',  # After DataFrame Indexing section
        'cells': [
            {
                'cell_type': 'code',
                'metadata': {'tags': ['thebe-interactive']},
                'source': [
                    "### EXERCISE: DataFrame Selection\n",
                    "# Using the employee DataFrame (df):\n",
                    "# 1. Select only the 'Years' and 'Rating' columns\n",
                    "# 2. Get Diana's complete record using `.loc[]`\n",
                    "\n",
                    "### Your code starts here:\n",
                    "\n",
                    "\n",
                    "\n",
                    "\n",
                    "### Your code ends here.\n"
                ],
                'outputs': [],
                'execution_count': None
            },
            {
                'cell_type': 'code',
                'metadata': {'tags': ['hide-input']},
                'source': [
                    "# Solution\n",
                    "\n",
                    "# 1. Select columns\n",
                    "df[['Years', 'Rating']]\n"
                ],
                'outputs': [],
                'execution_count': None
            }
        ]
    }
]

# Add exercises (in reverse order if multiple to maintain indices)
total_added = 0
for exercise_info in exercises_to_add:
    idx = find_cell_by_id(nb['cells'], exercise_info['after_id'])
    if idx is not None:
        for i, cell in enumerate(exercise_info['cells']):
            nb['cells'].insert(idx + 1 + i, cell)
            total_added += 1
        print(f"Inserted {len(exercise_info['cells'])} cells after {exercise_info['after_id']}")
    else:
        print(f"Could not find cell {exercise_info['after_id']}")

# Save the modified notebook
with open('0403-pd-dataframe.ipynb', 'w') as f:
    json.dump(nb, f, indent=1)

print(f"\n✅ Successfully added {total_added} exercise cells to the notebook!")
