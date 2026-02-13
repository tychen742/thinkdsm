document.addEventListener('DOMContentLoaded', function() {
    // Mark cells as executed when run button is clicked
    document.body.addEventListener('click', function(e) {
        const runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            const cell = runButton.closest('.thebelab-cell');
            if (cell) {
                // Mark as executed after a short delay
                setTimeout(function() {
                    cell.classList.add('thebelab-executed');
                }, 200);
            }
        }
    });
});