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
    
    // -----------------------------------------------------------
    // Fix for hide-input cells:
    //
    // sphinx-thebe's modifyDOMForThebe() moves cell_output INSIDE
    // the <details> element (next to cell_input).  thebelab.bootstrap()
    // then wraps both in .thebelab-cell, also inside <details>.
    // When <details> is closed the browser hides EVERYTHING inside,
    // including .thebelab-output — CSS cannot override this.
    //
    // Fix: after Thebe activates (adds class "thebelab-active" to
    // <body>), move each .thebelab-output that is trapped inside a
    // <details> out to its parent .cell container.  DOM references
    // in Thebe are preserved, so output still renders correctly.
    // -----------------------------------------------------------

    var bodyObserver = new MutationObserver(function(mutations) {
        for (var i = 0; i < mutations.length; i++) {
            if (mutations[i].attributeName === 'class' &&
                document.body.classList.contains('thebelab-active')) {
                bodyObserver.disconnect();
                fixHideInputOutputs();
                return;
            }
        }
    });
    bodyObserver.observe(document.body, { attributes: true });

    function fixHideInputOutputs() {
        // Short delay to let thebelab.bootstrap() finish creating cells
        setTimeout(function() {
            var cells = document.querySelectorAll('.tag_hide-input');
            console.log("[fix] Found " + cells.length + " hide-input cells");

            cells.forEach(function(cell) {
                var details = cell.querySelector('details');
                if (!details) return;

                var thebeOutput = details.querySelector('.thebelab-output');
                if (thebeOutput) {
                    // Move output right after <details>, still inside .cell
                    details.after(thebeOutput);
                    console.log("[fix] Moved .thebelab-output outside <details> for", cell.id);
                } else {
                    // Thebe may not have finished — watch for it
                    var watcher = new MutationObserver(function() {
                        var out = details.querySelector('.thebelab-output');
                        if (out) {
                            details.after(out);
                            console.log("[fix] (delayed) Moved .thebelab-output for", cell.id);
                            watcher.disconnect();
                        }
                    });
                    watcher.observe(details, { childList: true, subtree: true });
                }
            });
        }, 200);
    }
});