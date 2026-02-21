console.log("Custom JS loaded!");

// Handle sidebar toggle using event delegation (more reliable)
document.addEventListener('click', function(e) {
    const toggleButton = e.target.closest('button.sidebar-toggle.primary-toggle');
    
    if (toggleButton) {
        e.preventDefault();
        e.stopPropagation();
        
        const sidebar = document.querySelector('.bd-sidebar-primary');
        if (sidebar) {
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-visible');
            const isExpanded = sidebar.classList.contains('show');
            toggleButton.setAttribute('aria-expanded', isExpanded);
        }
        return false;
    }
    
    // Close sidebar when clicking outside
    const sidebar = document.querySelector('.bd-sidebar-primary');
    if (sidebar && document.body.classList.contains('sidebar-visible')) {
        if (!sidebar.contains(e.target) && !e.target.closest('button.sidebar-toggle.primary-toggle')) {
            sidebar.classList.remove('show');
            document.body.classList.remove('sidebar-visible');
        }
    }
}, true);

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");

    // -----------------------------------------------------------
    // Fix for tag_hide-input cells with Thebe active:
    //
    // After Thebe bootstraps, the entire .thebelab-cell ends up
    // inside <details>.  The browser hides all children of a closed
    // <details> — CSS cannot override this.  We need to pull the
    // output div (the anonymous div wrapping jp-OutputArea) OUT of
    // <details> and place it after, so it stays visible regardless
    // of whether the <details> is open or closed.
    // -----------------------------------------------------------

    function fixHideInputOutputs() {
        setTimeout(function() {
            document.querySelectorAll('.tag_hide-input').forEach(function(cell) {
                var details = cell.querySelector('details');
                if (!details) return;

                // Find .thebelab-cell inside <details>
                var thebelabCell = details.querySelector('.thebelab-cell');
                if (!thebelabCell) return;

                // Find the output wrapper: direct div child of .thebelab-cell
                // that contains jp-OutputArea
                var outputWrapper = null;
                thebelabCell.querySelectorAll(':scope > div').forEach(function(div) {
                    if (div.querySelector('.jp-OutputArea')) {
                        outputWrapper = div;
                    }
                });

                if (outputWrapper) {
                    details.after(outputWrapper);
                    console.log("[fix] Moved jp-OutputArea wrapper outside <details> for", cell.id);
                } else {
                    // Thebe hasn't rendered output yet — watch for it
                    var watcher = new MutationObserver(function() {
                        var wrapper = null;
                        thebelabCell.querySelectorAll(':scope > div').forEach(function(div) {
                            if (div.querySelector('.jp-OutputArea')) {
                                wrapper = div;
                            }
                        });
                        if (wrapper) {
                            details.after(wrapper);
                            console.log("[fix] (delayed) Moved jp-OutputArea wrapper outside <details> for", cell.id);
                            watcher.disconnect();
                        }
                    });
                    watcher.observe(thebelabCell, { childList: true, subtree: true });
                }
            });
        }, 300);
    }

    // Watch for Thebe to activate (adds 'thebelab-active' class to body)
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
});