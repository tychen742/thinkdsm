document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('thebelab-run-button')) {
            const cell = e.target.closest('.thebelab-cell');
            if (cell) {
                const output = cell.querySelector('.thebelab-output');
                if (output) {
                    output.style.display = 'block';
                }
            }
        }
    });
});