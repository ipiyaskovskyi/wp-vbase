/**
 * Main JavaScript - Performance Theme
 * Optimized for performance with minimal DOM manipulation
 */

(function() {
    'use strict';

    // DOM Ready
    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    // Mobile Navigation
    function initMobileNav() {
        const toggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.nav-menu');
        
        if (!toggle || !menu) return;
        
        toggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('is-active');
        });
        
        // Close menu on outside click
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-active');
            }
        });
        
        // Close menu on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('is-active')) {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-active');
                toggle.focus();
            }
        });
    }

    // Lazy Load Images with IntersectionObserver
    function initLazyLoad() {
        if (!('IntersectionObserver' in window)) return;
        
        const images = document.querySelectorAll('img[loading="lazy"]');
        
        const imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Handle srcset
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    
                    // Handle src
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                    
                    img.classList.add('is-loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });
        
        images.forEach(function(img) {
            imageObserver.observe(img);
        });
    }

    // Smooth Scroll for anchor links
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;
                
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL without jumping
                    history.pushState(null, null, href);
                }
            });
        });
    }

    // Header scroll behavior
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;
        
        let lastScroll = 0;
        let ticking = false;
        
        function updateHeader() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                header.classList.remove('is-scrolled', 'is-hidden');
            } else if (currentScroll > lastScroll && currentScroll > 100) {
                header.classList.add('is-hidden');
            } else {
                header.classList.remove('is-hidden');
                header.classList.add('is-scrolled');
            }
            
            lastScroll = currentScroll;
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }, { passive: true });
    }

    // Form validation
    function initFormValidation() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(function(field) {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                    
                    // Email validation
                    if (field.type === 'email' && field.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            isValid = false;
                            field.classList.add('is-invalid');
                        }
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    }

    // Copy to clipboard
    function initCopyButtons() {
        document.querySelectorAll('[data-copy]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const text = this.dataset.copy;
                
                navigator.clipboard.writeText(text).then(function() {
                    btn.classList.add('is-copied');
                    setTimeout(function() {
                        btn.classList.remove('is-copied');
                    }, 2000);
                });
            });
        });
    }

    // Accordion
    function initAccordion() {
        document.querySelectorAll('.accordion-header').forEach(function(header) {
            header.addEventListener('click', function() {
                const item = this.parentElement;
                const content = this.nextElementSibling;
                const isOpen = item.classList.contains('is-open');
                
                // Close all
                document.querySelectorAll('.accordion-item.is-open').forEach(function(openItem) {
                    openItem.classList.remove('is-open');
                    openItem.querySelector('.accordion-content').style.maxHeight = null;
                });
                
                // Open clicked if was closed
                if (!isOpen) {
                    item.classList.add('is-open');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        });
    }

    // Back to top button
    function initBackToTop() {
        const btn = document.querySelector('.back-to-top');
        if (!btn) return;
        
        let ticking = false;
        
        function toggleBtn() {
            if (window.pageYOffset > 300) {
                btn.classList.add('is-visible');
            } else {
                btn.classList.remove('is-visible');
            }
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(toggleBtn);
                ticking = true;
            }
        }, { passive: true });
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Initialize all
    ready(function() {
        initMobileNav();
        initLazyLoad();
        initSmoothScroll();
        initHeaderScroll();
        initFormValidation();
        initCopyButtons();
        initAccordion();
        initBackToTop();
    });

})();

