console.log("Custom JS loaded!");

// Handle sidebar toggle using event delegation (more reliable)
document.addEventListener('click', function(e) {
    console.log("Click detected on:", e.target);
    console.log("Target classes:", e.target.className);
    
    const toggleButton = e.target.closest('button.sidebar-toggle.primary-toggle');
    console.log("Found toggle button:", toggleButton);
    
    if (toggleButton) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Toggle button clicked via delegation!");
        
        const sidebar = document.querySelector('.bd-sidebar-primary');
        if (sidebar) {
            // Toggle sidebar visibility
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-visible');
            
            // Update aria-expanded attribute
            const isExpanded = sidebar.classList.contains('show');
            toggleButton.setAttribute('aria-expanded', isExpanded);
            
            console.log("Sidebar toggled, visible:", isExpanded);
        } else {
            console.log("Sidebar not found");
        }
        return false;
    }
    
    // Close sidebar when clicking outside
    const sidebar = document.querySelector('.bd-sidebar-primary');
    if (sidebar && document.body.classList.contains('sidebar-visible')) {
        if (!sidebar.contains(e.target) && !e.target.closest('button.sidebar-toggle.primary-toggle')) {
            sidebar.classList.remove('show');
            document.body.classList.remove('sidebar-visible');
            console.log("Sidebar closed by clicking outside");
        }
    }
}, true); // Use capture phase

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");
    
    // Watch for when Thebe becomes active
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const body = document.body;
                if (body.classList.contains('thebelab-active')) {
                    // Open all hide-input details so their content is visible.
                    // CSS handles hiding the summary toggle and code input.
                    document.querySelectorAll('details.tag_hide-input').forEach(function(d) {
                        d.open = true;
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