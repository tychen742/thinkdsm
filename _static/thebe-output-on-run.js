document.addEventListener('DOMContentLoaded', function() {
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