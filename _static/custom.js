console.log("Custom JS loaded!");

// Handle sidebar toggle using event delegation (more reliable)
document.addEventListener('click', function (e) {
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

// ---- SINGLE DOMContentLoaded handler ----
document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM ready!");

    // -----------------------------------------------------------
    // FIX A: tag_hide-input (exercise answer) cells
    //
    // Thebe wraps the entire .thebelab-cell inside <details>, hiding
    // everything. We watch each cell and move the jp-OutputArea wrapper
    // outside <details> the instant Thebe creates it.
    // -----------------------------------------------------------
    // // Thebe activation detection: watch for .thebelab-cell to be created inside <details>, then move output.
    function moveOutputOutsideDetails(cell) {
        var details = cell.querySelector('details');
        if (!details) return;
        var thebelabCell = details.querySelector('.thebelab-cell');
        if (!thebelabCell) return;

        var outputWrapper = null;
        thebelabCell.querySelectorAll(':scope > div').forEach(function (div) {
            if (div.querySelector('.jp-OutputArea')) outputWrapper = div;
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

        var observer = new MutationObserver(function () {
            var thebelabCell = details.querySelector('.thebelab-cell');
            if (!thebelabCell) return;

            var outputObserver = new MutationObserver(function () {
                var outputWrapper = null;
                thebelabCell.querySelectorAll(':scope > div').forEach(function (div) {
                    if (div.querySelector('.jp-OutputArea')) outputWrapper = div;
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

    document.querySelectorAll('.tag_hide-input').forEach(watchExerciseCell);

    // -----------------------------------------------------------
    // FIX B: Demo cells — hide jp-OutputArea when Thebe activates.
    //
    // Since body.thebelab-active is never set by Thebe 0.8.2,
    // we detect activation by watching for the first
    // .thebelab-run-button to appear in the DOM, then add our own
    // class 'thebe-is-active' to body so CSS can target it.
    //
    // NOTE: thinkpy uses predefinedOutput: true (default), so
    // static outputs are visible. No Fix A needed — exercise cell
    // outputs are not hidden by Thebe in this config.
    // -----------------------------------------------------------

    var thebeActivated = false;

    var activationObserver = new MutationObserver(function () {
        if (thebeActivated) return;
        if (document.querySelector('.thebelab-run-button')) {
            thebeActivated = true;
            activationObserver.disconnect();
            document.body.classList.add('thebe-is-active');
            console.log("[fix B] Thebe detected — added thebe-is-active to body");

            // Bind directly to every run button now that they exist
            document.querySelectorAll('.thebelab-run-button').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var cell = btn.closest('.cell');
                    if (cell && !cell.classList.contains('tag_hide-input')) {
                        cell.classList.add('cell-has-run');
                        console.log("[fix B] Marked cell-has-run for", cell.id);
                    }
                });
            });
        }
    });
    activationObserver.observe(document.body, { childList: true, subtree: true });

    // Exercise counter labels
    const exercises = document.querySelectorAll('div.cell.tag_thebe-interactive');
    const total = exercises.length;

    exercises.forEach((exercise, index) => {
        // Skip if label already exists
        if (exercise.querySelector('.exercise-label')) return;

        const counter = index + 1;
        const label = document.createElement('div');
        label.className = 'exercise-label';
        label.innerHTML = `✏️ Interactive Exercise ${counter}/${total}`;
        label.style.cssText = `
            display: block;
            font-size: 0.85em;
            color: #771212;
            font-weight: bold;
            margin-bottom: 8px;
        `;
        exercise.insertBefore(label, exercise.firstChild);
    });
});