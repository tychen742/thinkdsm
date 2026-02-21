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
    // FIX A: tag_hide-input (exercise answer) cells
    //
    // Thebe wraps the entire .thebelab-cell inside <details>, hiding
    // everything. We watch each cell and move the jp-OutputArea wrapper
    // outside <details> the instant Thebe creates it, so expected output
    // stays visible.
    // -----------------------------------------------------------

    function moveOutputOutsideDetails(cell) {
        var details = cell.querySelector('details');
        if (!details) return;

        var thebelabCell = details.querySelector('.thebelab-cell');
        if (!thebelabCell) return;

        var outputWrapper = null;
        thebelabCell.querySelectorAll(':scope > div').forEach(function(div) {
            if (div.querySelector('.jp-OutputArea')) {
                outputWrapper = div;
            }
        });

        if (outputWrapper && !outputWrapper.dataset.movedOut) {
            outputWrapper.dataset.movedOut = '1';
            details.after(outputWrapper);
            console.log("[fix A] Moved output outside <details> for", cell.id);
        }
    }

    function watchExerciseCell(cell) {
        var details = cell.querySelector('details');
        if (!details) return;

        var observer = new MutationObserver(function() {
            var thebelabCell = details.querySelector('.thebelab-cell');
            if (!thebelabCell) return;

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
                    console.log("[fix A] (delayed) Moved output outside <details> for", cell.id);
                    outputObserver.disconnect();
                }
            });
            outputObserver.observe(thebelabCell, { childList: true, subtree: true });

            moveOutputOutsideDetails(cell);
            observer.disconnect();
        });

        observer.observe(details, { childList: true, subtree: true });
    }

    // Watch all exercise (hide-input) cells
    document.querySelectorAll('.tag_hide-input').forEach(watchExerciseCell);

    // -----------------------------------------------------------
    // FIX B: Demo cells — mark cell as "has-run" when student
    // clicks the run button. CSS handles the actual show/hide:
    //   - body.thebelab-active .cell:not(.cell-has-run) .jp-OutputArea { display: none }
    //   - body.thebelab-active .cell.cell-has-run .jp-OutputArea { display: block }
    // -----------------------------------------------------------

    document.addEventListener('click', function(e) {
        var runBtn = e.target.closest('.thebelab-run-button');
        if (runBtn) {
            var cell = runBtn.closest('.cell');
            if (cell && !cell.classList.contains('tag_hide-input')) {
                cell.classList.add('cell-has-run');
                console.log("[fix B] Marked cell-has-run for", cell.id);
            }
        }
    });
});