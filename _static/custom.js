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
    // Thebe wraps the entire .thebelab-cell inside <details>, which
    // hides everything including the output. We watch each cell and
    // move the jp-OutputArea wrapper outside <details> the instant
    // Thebe creates it, so the expected output stays visible.
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
    // FIX B: Demo cells — hide static cell_output when Thebe
    // activates. Output reappears once the student clicks "run"
    // (Thebe replaces static output with live jp-OutputArea output).
    // Skip tag_hide-input cells — those are handled by Fix A.
    // -----------------------------------------------------------

    var bodyObserver = new MutationObserver(function(mutations) {
        for (var i = 0; i < mutations.length; i++) {
            if (mutations[i].attributeName === 'class' &&
                document.body.classList.contains('thebelab-active')) {
                bodyObserver.disconnect();
                hideDemoCellOutputs();
                return;
            }
        }
    });
    bodyObserver.observe(document.body, { attributes: true });

    function hideDemoCellOutputs() {
        document.querySelectorAll('.cell:not(.tag_hide-input)').forEach(function(cell) {
            var staticOutput = cell.querySelector(':scope > .cell_output');
            if (staticOutput) {
                staticOutput.style.display = 'none';
                console.log("[fix B] Hid static output for demo cell", cell.id);
            }
        });
    }
});