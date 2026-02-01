// Auto-activate Thebe on page load
document.addEventListener('DOMContentLoaded', function() {
    let didInit = false;

    // Wait for Thebe button to be available
    const checkThebeButton = setInterval(function() {
        if (didInit) return;

        // Prefer calling initThebe() directly if available (avoids relying on button wiring)
        if (typeof window.initThebe === 'function') {
            // If Thebe is already active, don't re-run
            if (document.querySelectorAll('div.thebelab-cell').length === 0) {
                window.initThebe();
                didInit = true;
                console.log('Thebe auto-initialized (initThebe)');
                clearInterval(checkThebeButton);
            }
            return;
        }

        const thebeButton = document.querySelector('.thebe-launch-button');
        
        if (thebeButton) {
            clearInterval(checkThebeButton);
            
            // Auto-click the Live Code button
            // Small delay to ensure page is fully loaded
            setTimeout(function() {
                if (!thebeButton.classList.contains('thebelab-active')) {
                    thebeButton.click();
                    didInit = true;
                    console.log('Thebe auto-activated');
                }
            }, 500);
        }
    }, 100);
    
    // Stop checking after 10 seconds to avoid infinite loop
    setTimeout(function() {
        clearInterval(checkThebeButton);
    }, 10000);
});
