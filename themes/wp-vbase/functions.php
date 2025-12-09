<?php

if (!defined('ABSPATH')) {
    exit;
}

define('VBASE_VERSION', '1.0.0');
define('VBASE_DIR', get_template_directory());
define('VBASE_URI', get_template_directory_uri());

function vbase_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    
    register_nav_menus([
        'primary' => __('Primary Menu', 'vbase'),
        'footer'  => __('Footer Menu', 'vbase'),
    ]);
    
    add_image_size('vbase-large', 1200, 800, true);
    add_image_size('vbase-medium', 800, 600, true);
    add_image_size('vbase-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'vbase_setup');

function vbase_scripts(): void {
    wp_enqueue_style(
        'vbase-main',
        VBASE_URI . '/assets/css/main.min.css',
        [],
        VBASE_VERSION,
        'all'
    );
    
    if (is_front_page()) {
        wp_enqueue_style(
            'vbase-home',
            VBASE_URI . '/assets/css/home.min.css',
            ['vbase-main'],
            VBASE_VERSION,
            'all'
        );
    }
    
    wp_enqueue_script(
        'vbase-custom',
        VBASE_URI . '/assets/js/main.js',
        [],
        VBASE_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'vbase_scripts');

function vbase_prevent_webpack_errors() {
    ?>
    <script>
    (function() {
        'use strict';
        
        if (typeof self !== 'undefined') {
            Object.defineProperty(self, 'webpackChunkvbasenev', {
                value: [],
                writable: false,
                configurable: false
            });
        }
        
        var blockedFiles = /(index\.027a46d3|useSettings\.a2420bb7|utils\.e094ba95|muiPro\.b7a0afff|Footer\.1338e176|TooltipURLReport\.aeb148d3|index\.af5c4f3a)\.js/;
        var blockedPath = /\/assets\/js\/[a-f0-9]{8,}\.js$/;
        
        if (window.fetch) {
            var originalFetch = window.fetch;
            window.fetch = function(url) {
                if (typeof url === 'string' && (blockedFiles.test(url) || blockedPath.test(url))) {
                    return Promise.resolve(new Response('', {status: 200, statusText: 'OK'}));
                }
                return originalFetch.apply(this, arguments);
            };
        }
        
        var originalOpen = XMLHttpRequest.prototype.open;
        XMLHttpRequest.prototype.open = function(method, url) {
            if (typeof url === 'string' && (blockedFiles.test(url) || blockedPath.test(url))) {
                this._blocked = true;
                return;
            }
            return originalOpen.apply(this, arguments);
        };
        var originalSend = XMLHttpRequest.prototype.send;
        XMLHttpRequest.prototype.send = function() {
            if (this._blocked) {
                this.readyState = 4;
                this.status = 200;
                this.statusText = 'OK';
                this.responseText = '';
                if (this.onload) this.onload();
                if (this.onreadystatechange) this.onreadystatechange();
                return;
            }
            return originalSend.apply(this, arguments);
        };
        
        var originalCreateElement = document.createElement;
        document.createElement = function(tagName) {
            var el = originalCreateElement.call(document, tagName);
            if (tagName.toLowerCase() === 'script') {
                var originalSetAttribute = el.setAttribute;
                el.setAttribute = function(name, value) {
                    if (name === 'src' && typeof value === 'string' && (blockedFiles.test(value) || blockedPath.test(value))) {
                        return;
                    }
                    return originalSetAttribute.call(this, name, value);
                };
            }
            return el;
        };
        
        var originalError = console.error;
        console.error = function() {
            var msg = Array.prototype.join.call(arguments, ' ');
            if (blockedFiles.test(msg) || (msg.indexOf('404') !== -1 && blockedPath.test(msg))) {
                return;
            }
            return originalError.apply(console, arguments);
        };
    })();
    </script>
    <?php
}
add_action('wp_head', 'vbase_prevent_webpack_errors', -999);

function vbase_widgets_init(): void {
    register_sidebar([
        'name'          => __('Sidebar', 'vbase'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in the sidebar.', 'vbase'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
    
    register_sidebar([
        'name'          => __('Footer Widget Area 1', 'vbase'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer column 1.', 'vbase'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
    
    register_sidebar([
        'name'          => __('Footer Widget Area 2', 'vbase'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in footer column 2.', 'vbase'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'vbase_widgets_init');

