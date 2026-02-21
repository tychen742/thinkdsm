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
    // Thebe wraps the entire cell (input + output) inside <details>.
    // The browser hides everything inside a closed <details> and CSS
    // cannot override this.  We move the jp-OutputArea wrapper div
    // outside <details> so it stays visible at all times.
    //
    // Strategy: watch each tag_hide-input cell's <details> for when
    // Thebe adds .thebelab-cell inside it, then immediately move the
    // output wrapper out.  This fires per-cell so timing is exact.
    // -----------------------------------------------------------

    function moveOutputOutsideDetails(cell) {
        var details = cell.querySelector('details');
        if (!details) return;

        var thebelabCell = details.querySelector('.thebelab-cell');
        if (!thebelabCell) return;

        // Find the anonymous div wrapping jp-OutputArea
        var outputWrapper = null;
        thebelabCell.querySelectorAll(':scope > div').forEach(function(div) {
            if (div.querySelector('.jp-OutputArea')) {
                outputWrapper = div;
            }
        });

        if (outputWrapper && !outputWrapper.dataset.movedOut) {
            outputWrapper.dataset.movedOut = '1';
            details.after(outputWrapper);
            console.log("[fix] Moved output outside <details> for", cell.id);
        }
    }

    function watchCell(cell) {
        var details = cell.querySelector('details');
        if (!details) return;

        // Watch for Thebe to inject .thebelab-cell into <details>
        var observer = new MutationObserver(function() {
            var thebelabCell = details.querySelector('.thebelab-cell');
            if (!thebelabCell) return;

            // .thebelab-cell appeared — now watch it for the output div
            var outputObserver = new MutationObserver(function() {
                var outputWrapper = null;
                thebelabCell.querySelectorAll(':scope > div').forEach(function(div) {
                    if (div.querySelector('.jp-OutputArea')) {
                        outputWrapper = div;
                    }
                });
                if (outputWrapper && !outputWrapper.dataset.movedOut) {
                    outputWrapper.dataset.movedOut = '1';
                    details.after(outputWrapper);
                    console.log("[fix] Moved output outside <details> for", cell.id);
                    outputObserver.disconnect();
                }
            });
            outputObserver.observe(thebelabCell, { childList: true, subtree: true });

            // Also try immediately in case output already exists
            moveOutputOutsideDetails(cell);
            observer.disconnect();
        });

        observer.observe(details, { childList: true, subtree: true });
    }

    // Set up watchers for all tag_hide-input cells
    document.querySelectorAll('.tag_hide-input').forEach(watchCell);
});