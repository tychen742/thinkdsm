#!/bin/bash
# Direct execution to see the real error

cd /home/tychen/dsm
source .venv/bin/activate

echo "=== Attempting direct execution of 0401-pd-series.ipynb ==="
echo ""

# Try to execute with verbose output
jupyter nbconvert --to notebook --execute \
    chapters/04-pandas/0401-pd-series.ipynb \
    --output /tmp/test-pd-series-output.ipynb \
    --ExecutePreprocessor.timeout=300 \
    --debug \
    2>&1 | tee /tmp/detailed-execution.log

echo ""
echo "=== Checking for system-level errors ==="
echo ""

# Check for OOM kills in last 5 minutes
echo "Recent OOM kills:"
dmesg -T | grep -i "killed process\|out of memory" | tail -5

echo ""
echo "Recent segfaults:"
dmesg -T | grep -i "segfault" | tail -5

echo ""
echo "=== Trying cell-by-cell execution ==="
echo ""

# Execute cells one by one to find the problem
python3 << 'PYTHON_SCRIPT'
import json
import subprocess
import sys
import tempfile

try:
    # Read the notebook
    with open('chapters/04-pandas/0401-pd-series.ipynb', 'r') as f:
        nb = json.load(f)
    
    print(f"Notebook has {len(nb['cells'])} cells\n")
    
    # Try to execute each code cell individually
    code_cells = [cell for cell in nb['cells'] if cell['cell_type'] == 'code']
    print(f"Found {len(code_cells)} code cells\n")
    
    for i, cell in enumerate(code_cells[:5]):  # Test first 5 code cells
        print(f"\n{'='*60}")
        print(f"Testing code cell {i+1}/{len(code_cells)}")
        print(f"{'='*60}")
        
        source = ''.join(cell['source'])
        print(f"Code preview (first 200 chars):")
        print(source[:200])
        print("...")
        
        # Create a minimal notebook with just this cell
        test_nb = {
            'cells': [
                {
                    'cell_type': 'code',
                    'source': source,
                    'metadata': {},
                    'outputs': [],
                    'execution_count': None
                }
            ],
            'metadata': {
                'kernelspec': {
                    'display_name': 'Python 3',
                    'language': 'python',
                    'name': 'python3'
                }
            },
            'nbformat': 4,
            'nbformat_minor': 4
        }
        
        # Write test notebook
        with tempfile.NamedTemporaryFile(mode='w', suffix='.ipynb', delete=False) as f:
            json.dump(test_nb, f)
            test_path = f.name
        
        # Try to execute
        try:
            result = subprocess.run(
                ['jupyter', 'nbconvert', '--to', 'notebook', '--execute',
                 test_path, '--output', '/tmp/cell-test.ipynb',
                 '--ExecutePreprocessor.timeout=60'],
                capture_output=True,
                text=True,
                timeout=70
            )
            
            if result.returncode == 0:
                print("✓ Cell executed successfully")
            else:
                print(f"✗ Cell execution FAILED")
                print(f"Error output:")
                print(result.stderr[-500:] if len(result.stderr) > 500 else result.stderr)
                print(f"\n*** THIS CELL LIKELY CAUSES THE KERNEL DEATH ***")
                break
                
        except subprocess.TimeoutExpired:
            print("✗ Cell execution TIMEOUT (>60 seconds)")
            print(f"\n*** THIS CELL LIKELY CAUSES THE KERNEL DEATH ***")
            break
        except Exception as e:
            print(f"✗ Error testing cell: {e}")
            break
    
except Exception as e:
    print(f"Error in cell-by-cell testing: {e}")
    import traceback
    traceback.print_exc()
PYTHON_SCRIPT

echo ""
echo "=== Summary ==="
echo "Check /tmp/detailed-execution.log for full output"
echo ""
echo "If you see OOM kills or segfaults above, it's a memory/system issue"
echo "If a specific cell failed, that's your culprit"
