// Auto-activate Thebe on page load
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Thebe button to be available
    const checkThebeButton = setInterval(function() {
        const thebeButton = document.querySelector('.thebe-launch-button');
        
        if (thebeButton) {
            clearInterval(checkThebeButton);
            
            // Auto-click the Live Code button
            // Small delay to ensure page is fully loaded
            setTimeout(function() {
                if (!thebeButton.classList.contains('thebelab-active')) {
                    thebeButton.click();
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