console.log("Custom JS loaded!");

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");
    
    // When run button is clicked, mark cell to show output
    document.body.addEventListener('click', function(e) {
        const runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            console.log("Run button clicked!");
            const cell = runButton.closest('.thebelab-cell');
            if (cell) {
                console.log("Cell found, adding class");
                cell.classList.add('show-output');
            }
        }
    });
});