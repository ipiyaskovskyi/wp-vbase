/**
 * Customizer Live Preview
 * Updates the site preview in real-time when customizer settings change
 */

(function($) {
    'use strict';

    // Helper function to update CSS variable
    function updateCssVariable(varName, value) {
        document.documentElement.style.setProperty(varName, value);
    }
    
    // Helper to update Google Fonts
    function updateGoogleFont(fontFamily, isHeading) {
        var fontUrl = 'https://fonts.googleapis.com/css2?family=' + 
            fontFamily.replace(/ /g, '+') + ':wght@400;500;600;700;800&display=swap';
        
        // Check if font link exists, if not create it
        var linkId = isHeading ? 'customizer-heading-font' : 'customizer-body-font';
        var existingLink = document.getElementById(linkId);
        
        if (existingLink) {
            existingLink.href = fontUrl;
        } else {
            var link = document.createElement('link');
            link.id = linkId;
            link.rel = 'stylesheet';
            link.href = fontUrl;
            document.head.appendChild(link);
        }
    }

    // ========================================
    // TYPOGRAPHY
    // ========================================
    
    // Heading Font Family
    wp.customize('font_heading', function(value) {
        value.bind(function(newval) {
            updateGoogleFont(newval, true);
            updateCssVariable('--font-family-display', "'" + newval + "', var(--font-family)");
        });
    });
    
    // Heading Font Weight
    wp.customize('font_heading_weight', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-weight-heading', newval);
        });
    });
    
    // Body Font Family
    wp.customize('font_body', function(value) {
        value.bind(function(newval) {
            updateGoogleFont(newval, false);
            updateCssVariable('--font-family', "'" + newval + "', system-ui, -apple-system, sans-serif");
        });
    });
    
    // Body Font Weight
    wp.customize('font_body_weight', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-weight-body', newval);
        });
    });
    
    // Base Font Size
    wp.customize('font_size_base', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-size-base', newval + 'px');
        });
    });
    
    // H1 Size
    wp.customize('font_size_h1', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-size-5xl', newval + 'px');
        });
    });
    
    // H2 Size
    wp.customize('font_size_h2', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-size-4xl', newval + 'px');
        });
    });
    
    // H3 Size
    wp.customize('font_size_h3', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--font-size-2xl', newval + 'px');
        });
    });

    // ========================================
    // COLORS
    // ========================================

    // Primary Colors
    wp.customize('color_primary', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-primary', newval);
        });
    });

    wp.customize('color_primary_dark', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-primary-dark', newval);
        });
    });

    wp.customize('color_secondary', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-secondary', newval);
        });
    });

    // Accent Colors
    wp.customize('color_accent', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-accent', newval);
        });
    });

    wp.customize('color_accent_hover', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-accent-hover', newval);
        });
    });

    wp.customize('color_accent_light', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-accent-light', newval);
        });
    });

    // Background Colors
    wp.customize('color_background', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-background', newval);
        });
    });

    wp.customize('color_surface', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-surface', newval);
        });
    });

    wp.customize('color_surface_alt', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-surface-alt', newval);
        });
    });

    wp.customize('color_border', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-border', newval);
        });
    });

    // Text Colors
    wp.customize('color_text', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-text', newval);
        });
    });

    wp.customize('color_text_muted', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-text-muted', newval);
        });
    });

    wp.customize('color_text_light', function(value) {
        value.bind(function(newval) {
            updateCssVariable('--color-text-light', newval);
        });
    });

    // Hero Gradient
    wp.customize('hero_gradient_start', function(value) {
        value.bind(function(newval) {
            var middle = wp.customize('hero_gradient_middle').get();
            var end = wp.customize('hero_gradient_end').get();
            $('.hero-section').css('background', 
                'linear-gradient(180deg, ' + newval + ' 0%, ' + middle + ' 50%, ' + end + ' 100%)'
            );
        });
    });

    wp.customize('hero_gradient_middle', function(value) {
        value.bind(function(newval) {
            var start = wp.customize('hero_gradient_start').get();
            var end = wp.customize('hero_gradient_end').get();
            $('.hero-section').css('background', 
                'linear-gradient(180deg, ' + start + ' 0%, ' + newval + ' 50%, ' + end + ' 100%)'
            );
        });
    });

    wp.customize('hero_gradient_end', function(value) {
        value.bind(function(newval) {
            var start = wp.customize('hero_gradient_start').get();
            var middle = wp.customize('hero_gradient_middle').get();
            $('.hero-section').css('background', 
                'linear-gradient(180deg, ' + start + ' 0%, ' + middle + ' 50%, ' + newval + ' 100%)'
            );
        });
    });

    // CTA Section
    wp.customize('cta_background', function(value) {
        value.bind(function(newval) {
            $('.cta-section').css('background-color', newval);
            $('.pricing-card.featured').css('background-color', newval);
        });
    });

    wp.customize('cta_text_color', function(value) {
        value.bind(function(newval) {
            $('.cta-section').css('color', newval);
            $('.cta-section .cta-title').css('color', newval);
        });
    });

    // Content Updates
    wp.customize('hero_badge', function(value) {
        value.bind(function(newval) {
            $('.hero-badge').html('✨ ' + newval);
        });
    });

    wp.customize('hero_title', function(value) {
        value.bind(function(newval) {
            $('.hero-title').text(newval);
        });
    });

    wp.customize('hero_subtitle', function(value) {
        value.bind(function(newval) {
            $('.hero-subtitle').text(newval);
        });
    });

})(jQuery);

