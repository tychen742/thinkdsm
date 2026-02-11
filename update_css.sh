#!/bin/bash

# Script to quickly update CSS in Jupyter Book without full rebuild
# Usage: 
#   ./update_css.sh                    (if run from workspace root)
#   ./update_css.sh ~/workspace/dsm    (with explicit path)
#   ./update_css.sh /home/tychen/workspace/dsm

# Determine workspace directory
if [ -z "$1" ]; then
    # If no argument, use current directory
    if [ -f "_static/custom.css" ]; then
        WORKSPACE_DIR="."
    else
        # Otherwise use default
        WORKSPACE_DIR="${HOME}/workspace/dsm"
    fi
else
    WORKSPACE_DIR="$1"
fi

# Expand ~ to actual home directory
WORKSPACE_DIR=$(eval echo "$WORKSPACE_DIR")

SOURCE_CSS="$WORKSPACE_DIR/_static/custom.css"
BUILD_CSS="$WORKSPACE_DIR/_build/html/_static/custom.css"

# Check if source CSS exists
if [ ! -f "$SOURCE_CSS" ]; then
    echo "❌ Error: Source CSS not found at $SOURCE_CSS"
    exit 1
fi

# Check if build directory exists
if [ ! -d "$WORKSPACE_DIR/_build/html/_static" ]; then
    echo "⚠️  Build directory not found. Running initial build..."
    cd "$WORKSPACE_DIR"
    jupyter-book build . --quiet
fi

# Copy the CSS file
echo "📋 Copying custom.css to build output..."
cp "$SOURCE_CSS" "$BUILD_CSS"

if [ $? -eq 0 ]; then
    echo "✅ CSS updated successfully!"
    echo ""
    echo "Next steps:"
    echo "1. Refresh your browser with Cmd+Shift+R (hard refresh) to clear cache"
    echo "2. View the changes in your local server"
else
    echo "❌ Error: Failed to copy CSS file"
    exit 1
fi
