/**
 * Complete custom Thebe implementation
 * Replaces sphinx_thebe to avoid duplicates
 */
(function() {
    'use strict';
    
    // Prevent multiple initializations
    if (window.customThebeLoaded) {
        console.log('Custom Thebe already loaded');
        return;
    }
    window.customThebeLoaded = true;
    
    console.log('Loading custom Thebe implementation...');
    
    // Configuration
    const config = {
        repository: "tychen742/dsm",
        branch: "main",
        selector: "div.cell.tag_thebe-interactive",
        binderUrl: "https://mybinder.org"
    };
    
    // Create Live Code button
    function createThebeButton() {
        // Check if button already exists
        if (document.querySelector('.thebe-launch-button')) {
            console.log('Thebe button already exists');
            return;
        }
        
        // Find a good place to add the button (in the navbar)
        const navbar = document.querySelector('.bd-header__inner');
        if (!navbar) {
            console.log('Could not find navbar to add button');
            return;
        }
        
        const button = document.createElement('button');
        button.className = 'thebe-launch-button btn btn-sm btn-secondary';
        button.textContent = '🚀 Live Code';
        button.style.marginLeft = '10px';
        
        button.onclick = function() {
            if (button.classList.contains('thebelab-active')) {
                console.log('Thebe already active');
                return;
            }
            
            button.textContent = '⏳ Loading...';
            button.disabled = true;
            initializeThebe(button);
        };
        
        navbar.appendChild(button);
        console.log('Thebe button created');
        
        // Auto-click after 1 second
        setTimeout(function() {
            console.log('Auto-clicking Thebe button...');
            button.click();
        }, 1000);
    }
    
    // Initialize Thebe
    function initializeThebe(button) {
        // Load Thebe script
        const script = document.createElement('script');
        script.src = 'https://unpkg.com/thebe@latest/lib/index.js';
        
        script.onload = function() {
            console.log('Thebe library loaded');
            
            // Configure Thebe
            thebelab.bootstrap({
                requestKernel: true,
                binderOptions: {
                    repo: config.repository,
                    ref: config.branch
                },
                kernelOptions: {
                    name: 'python3',
                    path: '.'
                },
                selector: config.selector,
                predefinedOutput: true,
                mountActivateWidget: function() {
                    // Custom activation
                },
                mountStatusWidget: function() {
                    // Show status in button
                    button.textContent = '🔄 Connecting...';
                }
            }).then(function() {
                console.log('Thebe initialized successfully');
                button.textContent = '✅ Live Code Active';
                button.classList.add('thebelab-active');
                button.disabled = false;
                
                // Make only tagged cells editable
                makeInteractiveCellsEditable();
            }).catch(function(error) {
                console.error('Thebe initialization failed:', error);
                button.textContent = '❌ Failed to Load';
                button.disabled = false;
            });
        };
        
        script.onerror = function() {
            console.error('Failed to load Thebe library');
            button.textContent = '❌ Load Failed';
            button.disabled = false;
        };
        
        document.head.appendChild(script);
    }
    
    // Make interactive cells editable
    function makeInteractiveCellsEditable() {
        const interactiveCells = document.querySelectorAll(config.selector);
        console.log(`Found ${interactiveCells.length} interactive cells`);
        
        interactiveCells.forEach(function(cell, index) {
            // Add visual indicator
            cell.style.borderLeft = '4px solid #4CAF50';
            cell.style.paddingLeft = '10px';
            cell.style.backgroundColor = '#f9fff9';
            
            // Add label
            const label = document.createElement('div');
            label.textContent = '✏️ Interactive Exercise';
            label.style.fontSize = '0.85em';
            label.style.color = '#4CAF50';
            label.style.fontWeight = 'bold';
            label.style.marginBottom = '8px';
            cell.insertBefore(label, cell.firstChild);
        });
    }
    
    // Wait for page to load, then create button
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', createThebeButton);
    } else {
        createThebeButton();
    }
    
})();