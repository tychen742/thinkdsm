import json

with open('chapters/04-pandas/0403-pd-dataframe.ipynb') as f:
    nb = json.load(f)
    
    current_section = None
    issues = []
    
    for i, cell in enumerate(nb['cells']):
        source = cell.get('source', [])
        if isinstance(source, list):
            source = ''.join(source)
        
        if cell['cell_type'] == 'markdown':
            lines = source.split('\n')
            for line in lines:
                # Track major sections
                if line.startswith('## ') and not line.startswith('###'):
                    if current_section:
                        print(f"\n{'='*60}")
                    current_section = line.strip('# ').strip()
                    print(f"## {current_section}")
                    print(f"   (Cell {i})")
        
        # Check for orphaned short cells
        if cell['cell_type'] == 'markdown':
            if source and len(source.strip()) < 50 and not source.startswith('#'):
                # Short markdown cell, not a header
                print(f"   ⚠️  Cell {i}: SHORT CELL: '{source.strip()[:40]}'")
                issues.append((i, source.strip()))
        
        # Check for code cells with only comments
        if cell['cell_type'] == 'code':
            stripped = source.strip()
            if stripped.startswith('###') and '\n' not in stripped:
                print(f"   ⚠️  Cell {i}: COMMENT-ONLY CODE CELL: '{stripped[:50]}'")
                issues.append((i, stripped))
    
    print(f"\n{'='*60}")
    print(f"\nTOTAL ISSUES FOUND: {len(issues)}")
    for cell_num, content in issues:
        print(f"  Cell {cell_num}: {content[:60]}")
