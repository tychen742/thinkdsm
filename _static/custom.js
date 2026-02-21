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
    
    // Watch for when Thebe becomes active
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const body = document.body;
                if (body.classList.contains('thebelab-active')) {
                    // Nothing needed - <details open> is already in the HTML.
                    // CSS handles hiding .thebelab-input for hide-input cells.
                }
            }
        });
    });
    
    // Watch for class changes on body
    observer.observe(document.body, { attributes: true });
    
    // When run button is clicked, show that cell's output
    document.body.addEventListener('click', function(e) {
        const runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            console.log("Run button clicked!");
            const cell = runButton.closest('.thebelab-cell');
            if (cell) {
                console.log("Showing output for this cell");
                
                // Add the show-output class to make the output visible
                cell.classList.add('show-output');
                
                // Find parent details element (for hide-input cells)
                const parentDetails = cell.closest('details');
                if (parentDetails) {
                    console.log("Found parent details element");
                    // Keep details open to show output
                    parentDetails.setAttribute('open', 'true');
                    
                    // Alternatively, move output outside details element
                    setTimeout(function() {
                        const outputs = cell.querySelectorAll('.thebelab-output, .jp-OutputArea');
                        outputs.forEach(function(output) {
                            if (output && output.innerHTML.trim() !== '') {
                                // Clone and insert output after the details element
                                const outputClone = output.cloneNode(true);
                                outputClone.style.display = 'block';
                                outputClone.style.marginTop = '4px';
                                outputClone.classList.add('thebe-output-extracted');
                                
                                // Remove any previous extracted output
                                const prevExtracted = parentDetails.parentNode.querySelector('.thebe-output-extracted');
                                if (prevExtracted) {
                                    prevExtracted.remove();
                                }
                                
                                // Insert after details
                                parentDetails.parentNode.insertBefore(outputClone, parentDetails.nextSibling);
                                console.log("Output extracted from details element");
                            }
                        });
                    }, 1000);
                }
                
                // Also check for output after a short delay and ensure class is present
                setTimeout(function() {
                    if (cell.querySelector('.thebelab-output, .jp-OutputArea')) {
                        cell.classList.add('show-output');
                    }
                }, 500);
            }
        }
    });
});