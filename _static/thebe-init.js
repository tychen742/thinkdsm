// Initialize Thebe manually to prevent duplicates
(function() {
    'use strict';
    
    if (window.thebeInitialized) {
        return;
    }
    window.thebeInitialized = true;
    
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/thebe@0.8.2/lib/index.js';
    script.id = 'thebe-js';
    
    script.onload = function() {
        console.log('Thebe loaded successfully');
        
        window.thebeConfig = {
            requestKernel: false,
            binderOptions: {
                repo: "tychen742/dsm",
                ref: "main"
            },
            kernelOptions: {
                name: "python3",
                path: "."
            },
            selector: "div.cell.tag_thebe-interactive",
            predefinedOutput: true
        };
    };
    
    if (!document.getElementById('thebe-js')) {
        document.head.appendChild(script);
    }
})();
