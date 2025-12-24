(function() {
    'use strict';

    if (typeof self !== 'undefined' && !self.webpackChunkvbasenev) {
        self.webpackChunkvbasenev = [];
        self.webpackChunkvbasenev.forEach = function() {};
        self.webpackChunkvbasenev.push = function() {};
    }

    const menuToggle = document.querySelector('.header__mobile-toggle');
    const mobileIcon = document.querySelector('.header__mobile-icon');
    const headerNav = document.querySelector('.header__nav');
    const body = document.body;
    const header = document.querySelector('header');
    
    // Fixed header scroll effect
    if (header) {
        function handleScroll() {
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        
        // Initial check
        handleScroll();
        
        // Throttle scroll events for performance
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
    }
    
    if (menuToggle && headerNav) {
        menuToggle.addEventListener('click', function() {
            const isOpen = headerNav.classList.contains('is-open');
            
            if (isOpen) {
                headerNav.classList.remove('is-open');
                if (mobileIcon) mobileIcon.classList.remove('is-open');
                body.style.overflow = '';
            } else {
                headerNav.classList.add('is-open');
                if (mobileIcon) mobileIcon.classList.add('is-open');
                body.style.overflow = 'hidden';
            }
        });

        const navLinks = headerNav.querySelectorAll('.header__link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                headerNav.classList.remove('is-open');
                if (mobileIcon) mobileIcon.classList.remove('is-open');
                body.style.overflow = '';
            });
        });
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Blog Carousel Slider
    function initBlogCarousel() {
        const blogSlides = document.querySelectorAll('.b-blog .recent-item.slide-js, .b-blog .slide-js');
        const blogSlidesContainer = document.querySelector('.b-blog .slides-js, .b-blog .b-blog-slider-slides');
        const blogPrevBtn = document.querySelector('.b-blog .prev-js, .b-blog .b-blog-nav-prev');
        const blogNextBtn = document.querySelector('.b-blog .next-js, .b-blog .b-blog-nav-next');

        if (blogSlides.length > 0 && blogSlidesContainer && blogPrevBtn && blogNextBtn) {
            let currentSlide = 0;
            let itemsPerView = window.innerWidth < 768 ? 1 : 3;
            const gap = 32; // var(--space-xl) = 32px
            
            function getItemsPerView() {
                return window.innerWidth < 768 ? 1 : 3;
            }
            
            function updateSlider() {
                itemsPerView = getItemsPerView();
                const containerWidth = blogSlidesContainer.parentElement.offsetWidth;
                const slideWidth = (containerWidth - (gap * (itemsPerView - 1))) / itemsPerView;
                const maxSlide = Math.max(0, blogSlides.length - itemsPerView);
                
                // Ensure currentSlide doesn't exceed max
                if (currentSlide > maxSlide) {
                    currentSlide = maxSlide;
                }
                
                blogSlides.forEach((slide, index) => {
                    slide.style.width = slideWidth + 'px';
                    slide.style.flexShrink = '0';
                });
                
                const translateX = currentSlide * (slideWidth + gap);
                blogSlidesContainer.style.transition = 'transform 0.3s ease';
                blogSlidesContainer.style.transform = `translateX(-${translateX}px)`;
            }
            
            function goToNext() {
                const maxSlide = Math.max(0, blogSlides.length - itemsPerView);
                if (currentSlide < maxSlide) {
                    currentSlide++;
                } else {
                    currentSlide = 0; // Loop back to start
                }
                updateSlider();
            }
            
            function goToPrev() {
                const maxSlide = Math.max(0, blogSlides.length - itemsPerView);
                if (currentSlide > 0) {
                    currentSlide--;
                } else {
                    currentSlide = maxSlide; // Loop to end
                }
                updateSlider();
            }
            
            blogNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToNext();
            });
            
            blogPrevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToPrev();
            });
            
            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    const newItemsPerView = getItemsPerView();
                    if (newItemsPerView !== itemsPerView) {
                        currentSlide = 0;
                    }
                    updateSlider();
                }, 250);
            });
            
            // Initialize
            updateSlider();
        }
    }
    
    // Initialize carousel when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBlogCarousel);
    } else {
        initBlogCarousel();
    }

    // Reviews Slider
    function initReviewsSlider() {
        const reviewsCards = document.querySelectorAll('.b-about-reviews__card');
        const reviewsSlidesContainer = document.querySelector('.reviews-slides-js');
        const reviewsPrevBtn = document.querySelector('.reviews-prev-js');
        const reviewsNextBtn = document.querySelector('.reviews-next-js');
        const reviewDots = document.querySelectorAll('.b-about-reviews__nav-dot');

        if (reviewsCards.length > 1 && reviewsSlidesContainer && reviewsPrevBtn && reviewsNextBtn) {
            let currentSlide = 0;
            const itemsPerView = window.innerWidth < 768 ? 1 : 2;
            const gap = 40; // var(--space-2xl) = 40px

            function getItemsPerView() {
                return window.innerWidth < 768 ? 1 : 2;
            }

            function updateSlider() {
                const itemsPerView = getItemsPerView();
                const containerWidth = reviewsSlidesContainer.parentElement.offsetWidth;
                const cardWidth = (containerWidth - (gap * (itemsPerView - 1))) / itemsPerView;
                const maxSlide = Math.max(0, reviewsCards.length - itemsPerView);

                // Ensure currentSlide doesn't exceed max
                if (currentSlide > maxSlide) {
                    currentSlide = maxSlide;
                }

                reviewsCards.forEach((card, index) => {
                    card.style.width = cardWidth + 'px';
                    card.style.flexShrink = '0';
                });

                const translateX = currentSlide * (cardWidth + gap);
                reviewsSlidesContainer.style.transition = 'transform 0.4s ease';
                reviewsSlidesContainer.style.transform = `translateX(-${translateX}px)`;

                // Update dots
                reviewDots.forEach((dot, i) => {
                    if (i === currentSlide) {
                        dot.classList.add('is-active');
                    } else {
                        dot.classList.remove('is-active');
                    }
                });
            }

            function goToNext() {
                const itemsPerView = getItemsPerView();
                const maxSlide = Math.max(0, reviewsCards.length - itemsPerView);
                if (currentSlide < maxSlide) {
                    currentSlide++;
                } else {
                    currentSlide = 0; // Loop back to start
                }
                updateSlider();
            }

            function goToPrev() {
                const itemsPerView = getItemsPerView();
                const maxSlide = Math.max(0, reviewsCards.length - itemsPerView);
                if (currentSlide > 0) {
                    currentSlide--;
                } else {
                    currentSlide = maxSlide; // Loop to end
                }
                updateSlider();
            }

            reviewsNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToNext();
            });

            reviewsPrevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                goToPrev();
            });

            // Dot navigation
            reviewDots.forEach((dot, index) => {
                dot.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentSlide = index;
                    updateSlider();
                });
            });

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    const newItemsPerView = getItemsPerView();
                    if (newItemsPerView !== itemsPerView) {
                        currentSlide = 0;
                    }
                    updateSlider();
                }, 250);
            });

            // Initialize
            updateSlider();
        }
    }

    // Initialize reviews slider when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initReviewsSlider);
    } else {
        initReviewsSlider();
    }

    // Disable HTML5 validation for Contact Form 7 (CF7 has its own validation)
    // But allow CF7 to show error messages below the input
    function setupFormValidation() {
        const engagementSection = document.querySelector('.b-engagement');
        if (engagementSection) {
            // Disable HTML5 validation for Contact Form 7 forms (CF7 handles validation)
            const cf7Forms = engagementSection.querySelectorAll('.wpcf7-form');
            cf7Forms.forEach(function(form) {
                form.setAttribute('novalidate', 'novalidate');
            });

            // For fallback forms, add custom error message display
            const fallbackForms = engagementSection.querySelectorAll('.b-engagement__demo-form');
            fallbackForms.forEach(function(form) {
                const emailInput = form.querySelector('input[type="email"]');
                if (emailInput && !emailInput.parentElement.classList.contains('input-wrapper')) {
                    // Wrap input in a container for error message
                    const wrapper = document.createElement('div');
                    wrapper.className = 'input-wrapper';
                    emailInput.parentNode.insertBefore(wrapper, emailInput);
                    wrapper.appendChild(emailInput);
                    
                    // Create error message container
                    const errorContainer = document.createElement('span');
                    errorContainer.className = 'input-error-message';
                    errorContainer.style.display = 'none';
                    wrapper.appendChild(errorContainer);

                    // Handle form submission
                    form.addEventListener('submit', function(e) {
                        if (!emailInput.value || !emailInput.validity.valid) {
                            e.preventDefault();
                            errorContainer.textContent = emailInput.validationMessage || 'Please enter a valid email address.';
                            errorContainer.style.display = 'block';
                            emailInput.style.borderColor = '#dc3232';
                        } else {
                            errorContainer.style.display = 'none';
                            emailInput.style.borderColor = '';
                        }
                    });

                    // Clear error on input
                    emailInput.addEventListener('input', function() {
                        if (this.validity.valid && errorContainer) {
                            errorContainer.style.display = 'none';
                            this.style.borderColor = '';
                        }
                    });
                }
            });
        }
    }

    // Initialize form validation setup when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupFormValidation);
    } else {
        setupFormValidation();
    }

    // Add classes to Contact Form 7 markup for better styling
    function enhanceFormMarkup() {
        // Find all Contact Form 7 forms
        const cf7Forms = document.querySelectorAll('.wpcf7-form');
        
        cf7Forms.forEach(function(form) {
            const formParent = form.closest('.contact-page, .demo-page');
            const isContactPage = formParent && formParent.classList.contains('contact-page');
            const isDemoPage = formParent && formParent.classList.contains('demo-page');
            
            // Get all paragraph containers (CF7 wraps each field in <p>)
            // Use :scope > p for direct children, or filter children
            const fieldParagraphs = Array.from(form.children).filter(function(child) {
                return child.tagName === 'P';
            });
            
            // Track field types for better identification
            let nameFieldIndex = -1;
            let emailFieldIndex = -1;
            let textareaFields = [];
            let submitButtonIndex = -1;
            
            // First pass: identify field types
            fieldParagraphs.forEach(function(paragraph, index) {
                const input = paragraph.querySelector('input[type="text"], input[type="email"], input[type="tel"], input[type="url"]');
                const textarea = paragraph.querySelector('textarea');
                const checkbox = paragraph.querySelector('input[type="checkbox"]');
                const submitButton = paragraph.querySelector('button[type="submit"], input[type="submit"]');
                const label = paragraph.querySelector('label');
                
                if (submitButton) {
                    submitButtonIndex = index;
                } else if (textarea) {
                    textareaFields.push({ index: index, paragraph: paragraph, label: label });
                } else if (input) {
                    const labelText = label ? label.textContent.toLowerCase() : '';
                    if (labelText.includes('name') && nameFieldIndex === -1) {
                        nameFieldIndex = index;
                    } else if (labelText.includes('email') && emailFieldIndex === -1) {
                        emailFieldIndex = index;
                    }
                }
            });
            
            // Second pass: add classes based on identified structure
            fieldParagraphs.forEach(function(paragraph, index) {
                // Skip if paragraph was already processed or split
                if (paragraph.dataset.processed === 'true' || paragraph.dataset.split === 'true') {
                    return;
                }
                
                const input = paragraph.querySelector('input[type="text"], input[type="email"], input[type="tel"], input[type="url"]');
                const textarea = paragraph.querySelector('textarea');
                const checkbox = paragraph.querySelector('input[type="checkbox"]');
                const submitButton = paragraph.querySelector('button[type="submit"], input[type="submit"]');
                const label = paragraph.querySelector('label');
                
                // Add classes based on field type and position
                if (isContactPage) {
                    paragraph.classList.add('contact-form__field');
                    
                    // Check if paragraph contains both email input and textarea (special case)
                    const hasEmailInput = paragraph.querySelector('input[type="email"]');
                    const hasTextarea = paragraph.querySelector('textarea');
                    const hasBoth = hasEmailInput && hasTextarea;
                    
                    if (index === nameFieldIndex) {
                        paragraph.classList.add('contact-form__field--name', 'contact-form__field--half');
                    } else if (hasBoth) {
                        // Paragraph contains both Email and Textarea - split them into separate paragraphs
                        // Find labels that contain email input or textarea
                        const allLabels = paragraph.querySelectorAll('label');
                        let emailLabel = null;
                        let textareaLabel = null;
                        
                        allLabels.forEach(function(label) {
                            if (label.querySelector('input[type="email"]')) {
                                emailLabel = label;
                            }
                            if (label.querySelector('textarea')) {
                                textareaLabel = label;
                            }
                        });
                        
                        const submitBtn = paragraph.querySelector('button[type="submit"], input[type="submit"]');
                        
                        if (emailLabel && textareaLabel) {
                            // Create new paragraph for Email
                            const emailParagraph = document.createElement('p');
                            emailParagraph.className = 'contact-form__field contact-form__field--email contact-form__field--half';
                            
                            // Move email label to new paragraph (not clone, to preserve event handlers)
                            emailParagraph.appendChild(emailLabel);
                            
                            // Insert email paragraph after current paragraph
                            paragraph.parentNode.insertBefore(emailParagraph, paragraph.nextSibling);
                            
                            // Create new paragraph for Textarea
                            const textareaParagraph = document.createElement('p');
                            textareaParagraph.className = 'contact-form__field contact-form__field--message contact-form__field--full-width';
                            
                            // Move textarea label to new paragraph
                            textareaParagraph.appendChild(textareaLabel);
                            
                            // Insert textarea paragraph after email paragraph
                            emailParagraph.parentNode.insertBefore(textareaParagraph, emailParagraph.nextSibling);
                            
                            // If there's a submit button, create separate paragraph for it
                            let submitParagraph = null;
                            if (submitBtn) {
                                submitParagraph = document.createElement('p');
                                submitParagraph.className = 'contact-form__field contact-form__field--submit button-container form-submit-container contact-form__submit-container';
                                
                                // Move submit button to new paragraph
                                submitParagraph.appendChild(submitBtn);
                                
                                // Insert submit paragraph after textarea paragraph
                                textareaParagraph.parentNode.insertBefore(submitParagraph, textareaParagraph.nextSibling);
                            }
                            
                            // Remove original paragraph if it's now empty (only br tags left)
                            const remainingContent = Array.from(paragraph.childNodes).filter(function(node) {
                                return node.nodeType !== 3 || (node.nodeType === 3 && node.textContent.trim() !== '');
                            });
                            const onlyBrTags = remainingContent.length === 0 || 
                                (remainingContent.length === remainingContent.filter(function(node) {
                                    return node.nodeName === 'BR';
                                }).length);
                            
                            if (onlyBrTags) {
                                paragraph.remove();
                            } else {
                                // Mark original paragraph as split to avoid re-processing
                                paragraph.dataset.split = 'true';
                            }
                            
                            // Mark new paragraphs as processed
                            emailParagraph.dataset.processed = 'true';
                            textareaParagraph.dataset.processed = 'true';
                            if (submitBtn && submitParagraph) {
                                submitParagraph.dataset.processed = 'true';
                            }
                            
                            // Re-run enhancement to process new paragraphs (but skip split ones)
                            setTimeout(function() {
                                enhanceFormMarkup();
                            }, 0);
                            return; // Skip further processing of this paragraph
                        }
                    } else if (index === emailFieldIndex || hasEmailInput) {
                        paragraph.classList.add('contact-form__field--email', 'contact-form__field--half');
                    } else if (textarea) {
                        paragraph.classList.add('contact-form__field--message', 'contact-form__field--full-width');
                    } else if (submitButton) {
                        paragraph.classList.add('contact-form__field--submit', 'button-container', 'form-submit-container', 'contact-form__submit-container');
                    }
                } else if (isDemoPage) {
                    paragraph.classList.add('demo-form__field');
                    
                    if (textarea) {
                        paragraph.classList.add('demo-form__field--message', 'demo-form__field--full-width');
                    } else if (input) {
                        const labelText = label ? label.textContent.toLowerCase() : '';
                        if (labelText.includes('business email')) {
                            paragraph.classList.add('demo-form__field--full-width', 'demo-form__field--business-email');
                        } else {
                            paragraph.classList.add('demo-form__field--half');
                        }
                    } else if (checkbox) {
                        paragraph.classList.add('demo-form__field--checkbox', 'demo-form__field--full-width');
                    } else if (submitButton) {
                        paragraph.classList.add('demo-form__field--submit', 'button-container', 'form-submit-container', 'demo-form__submit-container');
                    }
                }
                
                // Add classes to inputs and textareas
                if (input) {
                    input.classList.add('form-input');
                    if (isContactPage) {
                        input.classList.add('contact-form__input');
                    } else if (isDemoPage) {
                        input.classList.add('demo-form__input');
                    }
                }
                
                if (textarea) {
                    textarea.classList.add('form-textarea');
                    if (isContactPage) {
                        textarea.classList.add('contact-form__textarea');
                    } else if (isDemoPage) {
                        textarea.classList.add('demo-form__textarea');
                    }
                }
                
                // Add classes to labels
                if (label) {
                    label.classList.add('form-label');
                    if (isContactPage) {
                        label.classList.add('contact-form__label');
                    } else if (isDemoPage) {
                        label.classList.add('demo-form__label');
                    }
                }
                
                // Mark paragraph as processed to avoid re-processing
                paragraph.dataset.processed = 'true';
            });
            
            // Handle dataset-form-block-fields structure for demo page
            if (isDemoPage) {
                const datasetFields = form.querySelectorAll('.dataset-form-block-fields');
                
                datasetFields.forEach(function(container) {
                    // Check if container has only one full-width item
                    const oneColItems = container.querySelectorAll('.dataset-form-block-fields-item-one-col');
                    const leftItems = container.querySelectorAll('.dataset-form-block-fields-left');
                    const rightItems = container.querySelectorAll('.dataset-form-block-fields-right');
                    
                    if (oneColItems.length > 0 && leftItems.length === 0 && rightItems.length === 0) {
                        container.classList.add('dataset-form-block-fields--single-col');
                    }
                    
                    // Add classes to items
                    oneColItems.forEach(function(item) {
                        item.classList.add('dataset-form-block-fields-item', 'dataset-form-block-fields-item--full-width');
                    });
                });
            }
        });
    }

    // Initialize form markup enhancement when DOM is ready
    // Also run after CF7 AJAX submissions (forms are re-rendered)
    function initFormMarkupEnhancement() {
        enhanceFormMarkup();
        
        // Re-enhance after CF7 AJAX form submissions
        document.addEventListener('wpcf7mailsent', function() {
            enhanceFormMarkup();
        });
        
        document.addEventListener('wpcf7invalid', function() {
            enhanceFormMarkup();
        });
        
        // Also enhance on DOM mutations (for dynamically loaded forms)
        if (window.MutationObserver) {
            const observer = new MutationObserver(function(mutations) {
                let shouldEnhance = false;
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length > 0) {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1 && (node.classList.contains('wpcf7-form') || node.querySelector('.wpcf7-form'))) {
                                shouldEnhance = true;
                            }
                        });
                    }
                });
                if (shouldEnhance) {
                    enhanceFormMarkup();
                }
            });
            
            // Observe changes to the document body
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    }

    // Initialize form markup enhancement when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFormMarkupEnhancement);
    } else {
        initFormMarkupEnhancement();
    }

    // Handle footer newsletter form validation and prevent hash/scroll
    function setupFooterNewsletterForm() {
        const footerNewsletter = document.querySelector('.footer-newsletter');
        if (!footerNewsletter) return;

        const form = footerNewsletter.querySelector('.wpcf7-form');
        if (!form) return;

        // Prevent hash from being added to URL and page refresh
        form.addEventListener('submit', function(e) {
            // Store current scroll position
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            
            // Prevent default form behavior that adds hash
            const formAction = form.getAttribute('action');
            if (formAction && formAction.includes('#')) {
                form.setAttribute('data-original-action', formAction);
                form.setAttribute('action', formAction.split('#')[0]);
            }
            
            // Ensure form uses AJAX (CF7 should handle this, but we ensure it)
            if (!form.classList.contains('ajax')) {
                form.classList.add('ajax');
            }
            
            // Prevent page refresh - CF7 should use AJAX, but prevent default just in case
            // Only prevent if CF7 is properly initialized
            const hasAjaxClass = form.classList.contains('ajax') || form.classList.contains('init');
            if (hasAjaxClass) {
                // CF7 is initialized, let it handle the submission via AJAX
                // But prevent any hash navigation
                const hash = window.location.hash;
                if (hash && (hash.includes('wpcf7') || hash.includes('f45'))) {
                    e.preventDefault();
                    // Let CF7 handle the submission, but prevent hash navigation
                    setTimeout(function() {
                        if (window.location.hash) {
                            window.history.replaceState(null, null, window.location.href.split('#')[0]);
                        }
                    }, 0);
                }
            } else {
                // CF7 might not be initialized - prevent default to avoid page refresh
                // This is a fallback, but CF7 should always be initialized
                console.warn('CF7 form may not be properly initialized, preventing default submit');
                e.preventDefault();
            }
        }, { passive: false });

        // Store scroll position before form submission
        let savedScrollPosition = 0;
        
        form.addEventListener('submit', function() {
            // Save current scroll position
            savedScrollPosition = window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
        });

        // Handle CF7 validation events
        document.addEventListener('wpcf7invalid', function(event) {
            const formElement = event.target;
            if (formElement && footerNewsletter.contains(formElement)) {
                // Remove hash from URL if it was added
                if (window.location.hash) {
                    const newUrl = window.location.href.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                }
                
                // Prevent scroll - restore saved position
                requestAnimationFrame(function() {
                    window.scrollTo(0, savedScrollPosition);
                });
                
                // Also prevent scroll after a short delay
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 0);
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 100);
                
                // Show error message if not visible
                const errorOutput = formElement.querySelector('.wpcf7-response-output');
                if (errorOutput && errorOutput.textContent.trim()) {
                    errorOutput.style.display = 'block';
                    errorOutput.setAttribute('aria-hidden', 'false');
                }
            }
        }, false);

        // Handle successful submission
        document.addEventListener('wpcf7mailsent', function(event) {
            const formElement = event.target;
            if (formElement && footerNewsletter.contains(formElement)) {
                // Remove hash from URL
                if (window.location.hash) {
                    const newUrl = window.location.href.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                }
                
                // Prevent scroll - restore saved position
                requestAnimationFrame(function() {
                    window.scrollTo(0, savedScrollPosition);
                });
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 0);
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 100);
            }
        }, false);

        // Monitor URL changes and remove hash, prevent scroll
        let lastUrl = window.location.href;
        let scrollCheckInterval = setInterval(function() {
            const currentUrl = window.location.href;
            if (currentUrl !== lastUrl && window.location.hash) {
                const hash = window.location.hash;
                // Only remove hash if it's related to CF7 form
                if (hash.includes('wpcf7') || hash.includes('f45')) {
                    const newUrl = currentUrl.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                    // Prevent scroll after hash removal
                    window.scrollTo(0, savedScrollPosition);
                }
                lastUrl = window.location.href;
            }
            
            // Continuously prevent scroll if it changed
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
            if (savedScrollPosition > 0 && Math.abs(currentScroll - savedScrollPosition) > 10) {
                window.scrollTo(0, savedScrollPosition);
            }
        }, 50);
        
        // Clear interval after 3 seconds to avoid performance issues
        setTimeout(function() {
            clearInterval(scrollCheckInterval);
            savedScrollPosition = 0;
        }, 3000);
    }

    // Initialize footer newsletter form handling
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupFooterNewsletterForm);
    } else {
        setupFooterNewsletterForm();
    }

    // Handle blog newsletter form validation and prevent hash/scroll
    function setupBlogNewsletterForm() {
        const blogNewsletter = document.querySelector('.blog-newsletter');
        if (!blogNewsletter) return;

        const form = blogNewsletter.querySelector('.wpcf7-form');
        if (!form) return;

        // Prevent hash from being added to URL and page refresh
        form.addEventListener('submit', function(e) {
            // Store current scroll position
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            
            // Prevent default form behavior that adds hash
            const formAction = form.getAttribute('action');
            if (formAction && formAction.includes('#')) {
                form.setAttribute('data-original-action', formAction);
                form.setAttribute('action', formAction.split('#')[0]);
            }
            
            // Ensure form uses AJAX (CF7 should handle this, but we ensure it)
            if (!form.classList.contains('ajax')) {
                form.classList.add('ajax');
            }
            
            // Prevent page refresh - CF7 should use AJAX, but prevent default just in case
            const hasAjaxClass = form.classList.contains('ajax') || form.classList.contains('init');
            if (hasAjaxClass) {
                const hash = window.location.hash;
                if (hash && hash.includes('wpcf7')) {
                    e.preventDefault();
                    setTimeout(function() {
                        if (window.location.hash) {
                            window.history.replaceState(null, null, window.location.href.split('#')[0]);
                        }
                    }, 0);
                }
            }
        }, { passive: false });

        // Store scroll position before form submission
        let savedScrollPosition = 0;
        
        form.addEventListener('submit', function() {
            savedScrollPosition = window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
        });

        // Handle CF7 validation events
        document.addEventListener('wpcf7invalid', function(event) {
            const formElement = event.target;
            if (formElement && blogNewsletter.contains(formElement)) {
                // Remove hash from URL if it was added
                if (window.location.hash) {
                    const newUrl = window.location.href.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                }
                
                // Prevent scroll - restore saved position
                requestAnimationFrame(function() {
                    window.scrollTo(0, savedScrollPosition);
                });
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 0);
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 100);
            }
        }, false);

        // Handle successful submission
        document.addEventListener('wpcf7mailsent', function(event) {
            const formElement = event.target;
            if (formElement && blogNewsletter.contains(formElement)) {
                // Remove hash from URL
                if (window.location.hash) {
                    const newUrl = window.location.href.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                }
                
                // Prevent scroll - restore saved position
                requestAnimationFrame(function() {
                    window.scrollTo(0, savedScrollPosition);
                });
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 0);
                
                setTimeout(function() {
                    window.scrollTo(0, savedScrollPosition);
                }, 100);
            }
        }, false);

        // Monitor URL changes and remove hash, prevent scroll
        let lastUrl = window.location.href;
        let scrollCheckInterval = setInterval(function() {
            const currentUrl = window.location.href;
            if (currentUrl !== lastUrl && window.location.hash) {
                const hash = window.location.hash;
                if (hash.includes('wpcf7')) {
                    const newUrl = currentUrl.split('#')[0];
                    window.history.replaceState(null, null, newUrl);
                    window.scrollTo(0, savedScrollPosition);
                }
                lastUrl = window.location.href;
            }
            
            // Continuously prevent scroll if it changed
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
            if (savedScrollPosition > 0 && Math.abs(currentScroll - savedScrollPosition) > 10) {
                window.scrollTo(0, savedScrollPosition);
            }
        }, 50);
        
        // Clear interval after 3 seconds to avoid performance issues
        setTimeout(function() {
            clearInterval(scrollCheckInterval);
            savedScrollPosition = 0;
        }, 3000);
    }

    // Initialize blog newsletter form handling
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupBlogNewsletterForm);
    } else {
        setupBlogNewsletterForm();
    }

})();


