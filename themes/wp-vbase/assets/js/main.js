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

})();

