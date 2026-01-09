#!/bin/bash

# Deploy script for Jupyter Book to production server
# Usage: ./deploy.sh

sudo -v  # Authenticate once at the start

set -e  # Exit on any error

echo "======================================"
echo "Starting Jupyter Book deployment..."
echo "======================================"

# Step 1: Git operations
echo ""
echo "[1/3] Committing and pushing to GitHub..."
source ~/.ty/gitit.sh  # Source the gitit script instead of calling it


# Step 2: Build Jupyter Book
echo ""
echo "[2/3] Building Jupyter Book..."
jbb

# Step 3: Upload to server
echo ""
echo "[3/3] Uploading to production server..."
sudo ./load.sh

echo ""
echo "======================================"
echo "Deployment complete!"
echo "======================================"