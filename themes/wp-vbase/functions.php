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

/**
 * Add Favicon Support
 */
function vbase_favicon(): void {
    $favicon_dir = VBASE_URI . '/assets/images/favicon';
    $favicon_dir_path = VBASE_DIR . '/assets/images/favicon';
    
    // Standard favicon.ico
    if (file_exists($favicon_dir_path . '/favicon.ico')) {
        echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_dir . '/favicon.ico') . '">' . "\n";
    }
    
    // PNG favicons for different sizes
    $favicon_sizes = ['16x16', '32x32', '96x96'];
    foreach ($favicon_sizes as $size) {
        $file_path = $favicon_dir_path . '/favicon-' . $size . '.png';
        if (file_exists($file_path)) {
            echo '<link rel="icon" type="image/png" sizes="' . esc_attr($size) . '" href="' . esc_url($favicon_dir . '/favicon-' . $size . '.png') . '">' . "\n";
        }
    }
    
    // Apple Touch Icons
    $apple_sizes = ['57x57', '60x60', '72x72', '76x76', '114x114', '120x120', '144x144', '152x152', '180x180'];
    foreach ($apple_sizes as $size) {
        $file_path = $favicon_dir_path . '/apple-icon-' . $size . '.png';
        if (file_exists($file_path)) {
            echo '<link rel="apple-touch-icon" sizes="' . esc_attr($size) . '" href="' . esc_url($favicon_dir . '/apple-icon-' . $size . '.png') . '">' . "\n";
        }
    }
    
    // Android Chrome icon
    if (file_exists($favicon_dir_path . '/android-icon-192x192.png')) {
        echo '<link rel="icon" type="image/png" sizes="192x192" href="' . esc_url($favicon_dir . '/android-icon-192x192.png') . '">' . "\n";
    }
    
    // Web manifest
    if (file_exists($favicon_dir_path . '/manifest.json')) {
        echo '<link rel="manifest" href="' . esc_url($favicon_dir . '/manifest.json') . '">' . "\n";
    }
}
add_action('wp_head', 'vbase_favicon', 1);

