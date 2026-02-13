console.log("Custom JS loaded!");

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");
    
    // Watch for when Thebe becomes active
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const body = document.body;
                if (body.classList.contains('thebelab-active')) {
                    console.log("Thebe activated! Hiding all outputs...");
                    // Hide all outputs immediately when Thebe activates
                    document.querySelectorAll('.cell_output, .thebelab-output, .jp-OutputArea').forEach(function(output) {
                        output.style.display = 'none';
                    });
                }
            }
        });
    });
    
    // Watch for class changes on body
    observer.observe(document.body, { attributes: true });
    
    // When run button is clicked, show that cell's output
    document.body.addEventListener('click', function(e) {
        const runButton = e.target.closest('.thebelab-run-button');
        if (runButton) {
            console.log("Run button clicked!");
            const cell = runButton.closest('.thebelab-cell');
            if (cell) {
                console.log("Showing output for this cell");
                setTimeout(function() {
                    const outputs = cell.querySelectorAll('.thebelab-output, .jp-OutputArea');
                    outputs.forEach(function(output) {
                        output.style.display = 'block';
                    });
                }, 200);
            }
        }
    });
});