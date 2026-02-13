document.addEventListener('DOMContentLoaded', function() {
    // When run button is clicked, mark cell to show output
    document.body.addEventListener('click', function(e) {
        const runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            const cell = runButton.closest('.thebelab-cell');
            if (cell) {
                cell.classList.add('show-output');
            }
        }
    });
});