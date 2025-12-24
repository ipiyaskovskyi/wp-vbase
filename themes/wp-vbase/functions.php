<?php

if (!defined('ABSPATH')) {
    exit;
}

define('VBASE_DIR', get_template_directory());
define('VBASE_URI', get_template_directory_uri());

// ============================================
// Helper Functions
// ============================================

/**
 * Get theme version from version file
 * Reads the file dynamically on each call to avoid caching issues
 */
function vbase_get_version(): string {
    $version_file = VBASE_DIR . '/version.txt';
    
    // Clear stat cache to ensure we get fresh file info
    clearstatcache(true, $version_file);
    
    if (file_exists($version_file)) {
        $version = trim(file_get_contents($version_file));
        
        if (!empty($version)) {
            return $version;
        }
    }
    
    // Fallback to timestamp if file doesn't exist or is empty
    return (string) time();
}

/**
 * Check if current page matches template or slug
 *
 * @param string $template_name Template filename (e.g., 'page-contact.php')
 * @param string $slug Page slug (e.g., 'contact')
 * @return bool
 */
function vbase_is_page(string $template_name, string $slug): bool {
    return is_page_template($template_name) || 
           (is_page() && (get_page_template_slug() === $template_name || get_post_field('post_name') === $slug));
}

/**
 * Enqueue page-specific stylesheet
 *
 * @param string $handle Style handle
 * @param string $filename CSS filename (without .min.css extension)
 * @param array $deps Dependencies
 */
function vbase_enqueue_page_style(string $handle, string $filename, array $deps = ['vbase-main']): void {
    wp_enqueue_style(
        $handle,
        VBASE_URI . '/assets/css/' . $filename . '.min.css',
        $deps,
        vbase_get_version(),
        'all'
    );
}

/**
 * Enqueue page-specific script
 *
 * @param string $handle Script handle
 * @param string $filename JS filename (without .min.js extension)
 * @param array $deps Dependencies
 * @param bool $in_footer Load in footer
 */
function vbase_enqueue_page_script(string $handle, string $filename, array $deps = [], bool $in_footer = true): void {
    // Try to load .js file first, fallback to .min.js if not found
    $js_file = VBASE_DIR . '/assets/js/' . $filename . '.js';
    $js_url = file_exists($js_file) 
        ? VBASE_URI . '/assets/js/' . $filename . '.js'
        : VBASE_URI . '/assets/js/' . $filename . '.min.js';
    
    wp_enqueue_script(
        $handle,
        $js_url,
        $deps,
        vbase_get_version(),
        $in_footer
    );
}

// ============================================
// Theme Setup
// ============================================

/**
 * Theme setup
 */
function vbase_setup(): void {
    // Theme supports
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
    
    // Navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'vbase'),
        'footer'  => __('Footer Menu', 'vbase'),
    ]);
    
    // Image sizes
    add_image_size('vbase-large', 1200, 800, true);
    add_image_size('vbase-medium', 800, 600, true);
    add_image_size('vbase-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'vbase_setup');

// ============================================
// Scripts and Styles
// ============================================

/**
 * Enqueue scripts and styles
 */
function vbase_scripts(): void {
    // Material Icons
    wp_enqueue_style(
        'material-icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        [],
        null,
        'all'
    );
    
    // Main stylesheet
    vbase_enqueue_page_style('vbase-main', 'main', []);
    
    // Home page styles
    if (is_front_page()) {
        vbase_enqueue_page_style('vbase-home', 'home');
    }
    
    // Page-specific styles
    if (vbase_is_page('page-contact.php', 'contact')) {
        vbase_enqueue_page_style('vbase-contact', 'contact');
    }
    
    if (vbase_is_page('page-pricing.php', 'pricing')) {
        vbase_enqueue_page_style('vbase-pricing', 'pricing');
        vbase_enqueue_page_script('vbase-faq', 'faq');
    }
    
    if (vbase_is_page('page-about.php', 'about')) {
        vbase_enqueue_page_style('vbase-about', 'about');
    }
    
    if (vbase_is_page('page-request-a-demo.php', 'request-a-demo')) {
        vbase_enqueue_page_style('vbase-demo', 'demo');
    }
    
    // Blog-related pages styles (blog, search, category, single)
    $blog_page_id = get_option('page_for_posts');
    $is_blog_page = ($blog_page_id && is_page($blog_page_id)) || is_page_template('page-blog.php') || vbase_is_page('page-blog.php', 'blog');
    
    if (is_home() || $is_blog_page || is_search() || is_category() || (is_single() && get_post_type() === 'post')) {
        vbase_enqueue_page_style('vbase-blog', 'blog');
    }
    
    // Main JavaScript
    wp_enqueue_script(
        'vbase-custom',
        VBASE_URI . '/assets/js/main.js',
        [],
        vbase_get_version(),
        true
    );
}
add_action('wp_enqueue_scripts', 'vbase_scripts');

// ============================================
// Widgets
// ============================================

/**
 * Register widget areas
 */
function vbase_widgets_init(): void {
    $sidebars = [
        [
            'name'          => __('Sidebar', 'vbase'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in the sidebar.', 'vbase'),
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ],
        [
            'name'          => __('Footer Widget Area 1', 'vbase'),
            'id'            => 'footer-1',
            'description'   => __('Add widgets here to appear in footer column 1.', 'vbase'),
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ],
        [
            'name'          => __('Footer Widget Area 2', 'vbase'),
            'id'            => 'footer-2',
            'description'   => __('Add widgets here to appear in footer column 2.', 'vbase'),
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ],
    ];
    
    foreach ($sidebars as $sidebar) {
        register_sidebar([
            'name'          => $sidebar['name'],
            'id'            => $sidebar['id'],
            'description'   => $sidebar['description'],
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => $sidebar['before_title'],
            'after_title'   => $sidebar['after_title'],
        ]);
    }
}
add_action('widgets_init', 'vbase_widgets_init');

// ============================================
// Favicon Support
// ============================================

/**
 * Add favicon support
 */
function vbase_favicon(): void {
    $favicon_dir = VBASE_URI . '/assets/images/favicon';
    $favicon_dir_path = VBASE_DIR . '/assets/images/favicon';
    
    // Standard favicon.ico
    if (file_exists($favicon_dir_path . '/favicon.ico')) {
        echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_dir . '/favicon.ico') . '">' . "\n";
    }
    
    // PNG favicons
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

// ============================================
// Contact Page Permalink Management
// ============================================

/**
 * Contact page ID constant
 */
define('VBASE_CONTACT_PAGE_ID', 27);

/**
 * Set permalink for contact page to /contact
 */
function vbase_set_contact_permalink(): void {
    $page = get_post(VBASE_CONTACT_PAGE_ID);
    
    if (!$page || $page->post_type !== 'page') {
        return;
    }
    
    if ($page->post_name !== 'contact') {
        wp_update_post([
            'ID' => VBASE_CONTACT_PAGE_ID,
            'post_name' => 'contact',
        ]);
    }
}
add_action('init', 'vbase_set_contact_permalink', 1);

/**
 * Redirect ?page_id=27 to /contact
 */
function vbase_redirect_contact_page_id(): void {
    if (isset($_GET['page_id']) && $_GET['page_id'] == VBASE_CONTACT_PAGE_ID) {
        wp_redirect(home_url('/contact/'), 301);
        exit;
    }
}
add_action('template_redirect', 'vbase_redirect_contact_page_id');

/**
 * Filter permalink for contact page to always use /contact
 */
function vbase_contact_page_permalink(string $permalink, int $post_id): string {
    if ($post_id === VBASE_CONTACT_PAGE_ID) {
        return home_url('/contact/');
    }
    
    return $permalink;
}
add_filter('page_link', 'vbase_contact_page_permalink', 10, 2);

/**
 * Limit search to blog posts only and set posts per page to 9
 */
function vbase_search_only_posts(WP_Query $query): void {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
        $query->set('posts_per_page', 9);
    }
}
add_action('pre_get_posts', 'vbase_search_only_posts');
