// Add this to your custom.js or in a <script> tag
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Thebe to initialize
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                // Check if output was added
                if (node.classList && node.classList.contains('thebelab-output')) {
                    // Mark the parent cell as "ran"
                    const cell = node.closest('.thebelab-cell');
                    if (cell) {
                        cell.classList.add('thebelab-cell-ran');
                    }
                }
            });
        });
    });
    
    // Observe all thebelab cells
    document.querySelectorAll('.thebelab-cell').forEach(function(cell) {
        observer.observe(cell, { childList: true, subtree: true });
    });
});