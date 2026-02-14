console.log("Custom JS loaded!");

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM ready!");
    
    // Handle sidebar toggle for mobile/small screens
    const toggleButton = document.querySelector('button.sidebar-toggle.primary-toggle');
    const sidebar = document.querySelector('.bd-sidebar-primary');
    
    if (toggleButton && sidebar) {
        console.log("Sidebar toggle button found, adding click handler");
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Toggle button clicked!");
            
            // Toggle sidebar visibility
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-visible');
            
            // Update aria-expanded attribute
            const isExpanded = sidebar.classList.contains('show');
            toggleButton.setAttribute('aria-expanded', isExpanded);
            
            console.log("Sidebar toggled, visible:", isExpanded);
        });
        
        // Close sidebar when clicking outside (on overlay)
        document.addEventListener('click', function(e) {
            if (document.body.classList.contains('sidebar-visible') &&
                !sidebar.contains(e.target) &&
                !toggleButton.contains(e.target)) {
                sidebar.classList.remove('show');
                document.body.classList.remove('sidebar-visible');
                toggleButton.setAttribute('aria-expanded', 'false');
                console.log("Sidebar closed by clicking outside");
            }
        });
    } else {
        console.log("Toggle button or sidebar not found");
    }
    
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