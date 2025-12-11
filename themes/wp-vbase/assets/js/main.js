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

})();

