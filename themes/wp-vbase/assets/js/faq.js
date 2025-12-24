/**
 * FAQ Accordion Functionality
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const faqHeaders = document.querySelectorAll('.b-faq-block-qa-item-head');
        
        if (!faqHeaders.length) return;

        faqHeaders.forEach(function(header) {
            const content = header.nextElementSibling;
            if (!content) return;

            header.addEventListener('click', function(e) {
                e.preventDefault();
                
                const isActive = header.classList.contains('active');
                
                // Close all other FAQ items
                faqHeaders.forEach(function(otherHeader) {
                    if (otherHeader !== header) {
                        const otherContent = otherHeader.nextElementSibling;
                        if (otherContent) {
                            otherHeader.classList.remove('active');
                            otherContent.style.maxHeight = null;
                        }
                    }
                });

                // Toggle current item
                if (isActive) {
                    // Close current item
                    header.classList.remove('active');
                    content.style.maxHeight = null;
                } else {
                    // Open current item
                    header.classList.add('active');
                    
                    // Temporarily remove max-height restriction to get accurate scrollHeight
                    const tempMaxHeight = content.style.maxHeight;
                    content.style.maxHeight = 'none';
                    const scrollHeight = content.scrollHeight;
                    content.style.maxHeight = tempMaxHeight;
                    
                    // Set the correct height
                    requestAnimationFrame(function() {
                        content.style.maxHeight = scrollHeight + 'px';
                    });
                }
            });
        });
    });
})();

