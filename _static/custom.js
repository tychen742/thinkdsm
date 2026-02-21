console.log("Custom JS loaded!");

// Handle sidebar toggle using event delegation (more reliable)
document.addEventListener('click', function(e) {
    console.log("Click detected on:", e.target);
    console.log("Target classes:", e.target.className);
    
    const toggleButton = e.target.closest('button.sidebar-toggle.primary-toggle');
    console.log("Found toggle button:", toggleButton);
    
    if (toggleButton) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Toggle button clicked via delegation!");
        
        const sidebar = document.querySelector('.bd-sidebar-primary');
        if (sidebar) {
            // Toggle sidebar visibility
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-visible');
            
            // Update aria-expanded attribute
            const isExpanded = sidebar.classList.contains('show');
            toggleButton.setAttribute('aria-expanded', isExpanded);
            
            console.log("Sidebar toggled, visible:", isExpanded);
        } else {
            console.log("Sidebar not found");
        }
        return false;
    }
    
    // Close sidebar when clicking outside
    const sidebar = document.querySelector('.bd-sidebar-primary');
    if (sidebar && document.body.classList.contains('sidebar-visible')) {
        if (!sidebar.contains(e.target) && !e.target.closest('button.sidebar-toggle.primary-toggle')) {
            sidebar.classList.remove('show');
            document.body.classList.remove('sidebar-visible');
            console.log("Sidebar closed by clicking outside");
        }
    }
}, true); // Use capture phase

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");
    
    // Watch for when Thebe becomes active, then set up output observers
    var bodyObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class' && document.body.classList.contains('thebelab-active')) {
                console.log("Thebe is now active — setting up output observers");
                setupOutputObservers();
            }
        });
    });
    bodyObserver.observe(document.body, { attributes: true });
    
    function setupOutputObservers() {
        // Find all thebelab-cells that are inside a <details> element
        var cells = document.querySelectorAll('details .thebelab-cell');
        console.log("Found " + cells.length + " thebelab-cells inside details elements");
        
        cells.forEach(function(cell) {
            var detailsEl = cell.closest('details');
            if (!detailsEl) return;
            
            // The parent div.cell container (where we'll place the output)
            var cellContainer = detailsEl.closest('.cell');
            if (!cellContainer) cellContainer = detailsEl.parentNode;
            
            // Watch for output being added to this cell's .thebelab-output
            var outputDiv = cell.querySelector('.thebelab-output');
            if (outputDiv) {
                observeOutput(outputDiv, detailsEl, cellContainer);
            }
            
            // Also watch the cell itself for new child elements (Thebe may add output later)
            var cellObserver = new MutationObserver(function(muts) {
                muts.forEach(function(m) {
                    m.addedNodes.forEach(function(node) {
                        if (node.classList && (node.classList.contains('thebelab-output') || node.classList.contains('jp-OutputArea'))) {
                            observeOutput(node, detailsEl, cellContainer);
                        }
                    });
                });
            });
            cellObserver.observe(cell, { childList: true });
        });
    }
    
    function observeOutput(outputDiv, detailsEl, cellContainer) {
        // Create or find the external output container
        var externalOutput = cellContainer.querySelector('.thebe-external-output');
        if (!externalOutput) {
            externalOutput = document.createElement('div');
            externalOutput.className = 'thebe-external-output';
            // Insert after the details element
            if (detailsEl.nextSibling) {
                detailsEl.parentNode.insertBefore(externalOutput, detailsEl.nextSibling);
            } else {
                detailsEl.parentNode.appendChild(externalOutput);
            }
        }
        
        // Watch for content being added to the output div
        var outputObserver = new MutationObserver(function() {
            // Copy content to external output
            if (outputDiv.innerHTML.trim() !== '') {
                externalOutput.innerHTML = outputDiv.innerHTML;
                externalOutput.style.display = 'block';
                // Hide the original (it's trapped in details anyway)
                outputDiv.style.display = 'none';
                console.log("Output moved outside details element");
            }
        });
        outputObserver.observe(outputDiv, { childList: true, subtree: true, characterData: true });
    }
    
    // When run button is clicked, also ensure output is visible for non-details cells
    document.body.addEventListener('click', function(e) {
        var runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            console.log("Run button clicked!");
            var cell = runButton.closest('.thebelab-cell');
            if (!cell) return;
            
            // For cells NOT inside details, just make sure output is visible
            if (!cell.closest('details')) {
                var checks = 0;
                var interval = setInterval(function() {
                    var outputs = cell.querySelectorAll('.thebelab-output, .jp-OutputArea');
                    outputs.forEach(function(output) {
                        output.style.display = 'block';
                        output.style.visibility = 'visible';
                    });
                    checks++;
                    if (checks > 10) clearInterval(interval);
                }, 500);
            }
        }
    });
});