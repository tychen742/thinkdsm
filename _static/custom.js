// Auto-activate Thebe when fully ready
(function() {
    'use strict';
    
    function activateThebe() {
        const thebeButton = document.querySelector('.thebe-launch-button');
        
        if (!thebeButton) {
            console.log('Thebe button not found');
            return false;
        }
        
        if (thebeButton.classList.contains('thebelab-active')) {
            console.log('Thebe already active');
            return true;
        }
        
        // Check if thebelab is available
        if (typeof thebelab === 'undefined') {
            console.log('Thebelab not loaded yet');
            return false;
        }
        
        try {
            console.log('Attempting to activate Thebe...');
            thebeButton.click();
            return true;
        } catch (error) {
            console.error('Error activating Thebe:', error);
            return false;
        }
    }
    
    // Wait for page to be fully loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        // Try immediately
        setTimeout(function() {
            if (activateThebe()) {
                return;
            }
            
            // If failed, keep trying with exponential backoff
            let delay = 500;
            let attempts = 0;
            const maxAttempts = 10;
            
            function retry() {
                attempts++;
                
                if (activateThebe() || attempts >= maxAttempts) {
                    console.log(attempts >= maxAttempts ? 
                        'Max attempts reached' : 
                        'Thebe activated after ' + attempts + ' attempts');
                    return;
                }
                
                delay = Math.min(delay * 1.5, 3000);
                setTimeout(retry, delay);
            }
            
            setTimeout(retry, delay);
            
        }, 1500); // Initial delay to let page settle
    }
})();