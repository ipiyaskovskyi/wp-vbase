<?php
/**
 * Performance Theme Functions
 *
 * @package Performance_Theme
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('THEME_VERSION', '1.0.0');
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

/**
 * Get asset suffix based on environment
 * Returns '.min' for production, '' for development
 */
function performance_theme_asset_suffix(): string {
    return (defined('WP_DEBUG') && WP_DEBUG) ? '' : '.min';
}

/**
 * Theme Setup
 */
function performance_theme_setup(): void {
    // Add theme supports
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
    
    // Register navigation menus
    register_nav_menus([
        'primary'   => __('Primary Menu', 'performance-theme'),
        'footer'    => __('Footer Menu', 'performance-theme'),
    ]);
    
    // Add image sizes for responsive images
    add_image_size('hero-large', 1920, 1080, true);
    add_image_size('hero-medium', 1200, 675, true);
    add_image_size('card-thumb', 400, 300, true);
    add_image_size('card-thumb-2x', 800, 600, true);
}
add_action('after_setup_theme', 'performance_theme_setup');

/**
 * Enqueue Scripts and Styles with Performance Optimizations
 */
function performance_theme_scripts(): void {
    $suffix = performance_theme_asset_suffix();
    
    // Dequeue unnecessary scripts
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('global-styles');
    
    // Main stylesheet - use minified in production, normal in development
    wp_enqueue_style(
        'performance-theme-style',
        THEME_URI . '/assets/css/main' . $suffix . '.css',
        [],
        THEME_VERSION
    );
    
    // Main JavaScript - use minified in production, normal in development
    wp_enqueue_script(
        'performance-theme-script',
        THEME_URI . '/assets/js/main' . $suffix . '.js',
        [],
        THEME_VERSION,
        true
    );
    
    // Localize script for AJAX
    wp_localize_script('performance-theme-script', 'performanceTheme', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('performance_theme_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'performance_theme_scripts');

/**
 * Add Resource Hints for Performance
 */
function performance_theme_resource_hints(array $urls, string $relation_type): array {
    if ($relation_type === 'preconnect') {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    
    if ($relation_type === 'dns-prefetch') {
        $urls[] = '//www.google-analytics.com';
        $urls[] = '//www.googletagmanager.com';
    }
    
    return $urls;
}
add_filter('wp_resource_hints', 'performance_theme_resource_hints', 10, 2);

/**
 * Add Preload for Critical Resources
 */
function performance_theme_preload_resources(): void {
    $suffix = performance_theme_asset_suffix();
    echo '<link rel="preload" href="' . esc_url(THEME_URI . '/assets/css/critical' . $suffix . '.css') . '" as="style">' . "\n";
}
add_action('wp_head', 'performance_theme_preload_resources', 1);

/**
 * Inline Critical CSS
 */
function performance_theme_critical_css(): void {
    $suffix = performance_theme_asset_suffix();
    $critical_css_file = THEME_DIR . '/assets/css/critical' . $suffix . '.css';
    
    if (file_exists($critical_css_file)) {
        echo '<style id="critical-css">' . file_get_contents($critical_css_file) . '</style>' . "\n";
    }
}
add_action('wp_head', 'performance_theme_critical_css', 2);

/**
 * Add Async/Defer to Scripts
 */
function performance_theme_script_loader_tag(string $tag, string $handle, string $src): string {
    $async_scripts = ['google-analytics', 'gtm'];
    $defer_scripts = ['performance-theme-script', 'comment-reply'];
    
    if (in_array($handle, $async_scripts, true)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    if (in_array($handle, $defer_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'performance_theme_script_loader_tag', 10, 3);

/**
 * Add Display Swap to Google Fonts
 */
function performance_theme_style_loader_tag(string $tag, string $handle): string {
    if (strpos($handle, 'google-fonts') !== false) {
        $tag = str_replace("rel='stylesheet'", "rel='stylesheet' media='print' onload=\"this.media='all'\"", $tag);
        $tag = '<noscript>' . str_replace(" media='print' onload=\"this.media='all'\"", '', $tag) . '</noscript>' . $tag;
    }
    
    return $tag;
}
add_filter('style_loader_tag', 'performance_theme_style_loader_tag', 10, 2);

/**
 * Remove jQuery Migrate
 */
function performance_theme_remove_jquery_migrate(object $scripts): void {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
}
add_action('wp_default_scripts', 'performance_theme_remove_jquery_migrate');

/**
 * Disable Emojis for Performance
 */
function performance_theme_disable_emojis(): void {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    add_filter('tiny_mce_plugins', function(array $plugins): array {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
    });
    
    add_filter('wp_resource_hints', function(array $urls, string $relation_type): array {
        if ($relation_type === 'dns-prefetch') {
            $urls = array_filter($urls, function($url) {
                return strpos($url, 'https://s.w.org/images/core/emoji') === false;
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'performance_theme_disable_emojis');

/**
 * Remove Unnecessary Meta Tags
 */
function performance_theme_cleanup_head(): void {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11);
}
add_action('after_setup_theme', 'performance_theme_cleanup_head');

/**
 * Optimize Images - Add Loading Lazy and Decoding Async
 */
function performance_theme_optimize_images(string $content): string {
    if (is_admin() || is_feed()) {
        return $content;
    }
    
    // Add loading="lazy" and decoding="async" to images
    $content = preg_replace(
        '/<img((?!loading=)[^>]*)>/i',
        '<img$1 loading="lazy">',
        $content
    );
    
    $content = preg_replace(
        '/<img((?!decoding=)[^>]*)>/i',
        '<img$1 decoding="async">',
        $content
    );
    
    return $content;
}
add_filter('the_content', 'performance_theme_optimize_images', 999);
add_filter('post_thumbnail_html', 'performance_theme_optimize_images', 999);

/**
 * Add Fetchpriority to LCP Image
 */
function performance_theme_lcp_image(string $html, int $attachment_id, int|string $size, bool $icon, array $attr): string {
    if (is_front_page() && is_main_query() && in_the_loop() && $GLOBALS['wp_query']->current_post === 0) {
        $html = str_replace('<img', '<img fetchpriority="high"', $html);
        $html = str_replace('loading="lazy"', '', $html);
    }
    return $html;
}
add_filter('wp_get_attachment_image', 'performance_theme_lcp_image', 10, 5);

/**
 * Limit Post Revisions
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Add WebP Support
 */
function performance_theme_webp_support(array $mime_types): array {
    $mime_types['webp'] = 'image/webp';
    $mime_types['avif'] = 'image/avif';
    return $mime_types;
}
add_filter('upload_mimes', 'performance_theme_webp_support');

/**
 * Optimize Heartbeat API
 */
function performance_theme_heartbeat_settings(array $settings): array {
    $settings['interval'] = 60; // Increase interval to 60 seconds
    return $settings;
}
add_filter('heartbeat_settings', 'performance_theme_heartbeat_settings');

/**
 * Disable Heartbeat on Frontend
 */
function performance_theme_disable_heartbeat(): void {
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
}
add_action('init', 'performance_theme_disable_heartbeat', 1);

/**
 * Include Theme Modules
 */
require_once THEME_DIR . '/inc/class-performance-optimizer.php';
require_once THEME_DIR . '/inc/class-seo-manager.php';
require_once THEME_DIR . '/inc/class-schema-markup.php';
require_once THEME_DIR . '/inc/template-functions.php';
require_once THEME_DIR . '/inc/customizer.php';

/**
 * Widget Areas
 */
function performance_theme_widgets_init(): void {
    register_sidebar([
        'name'          => __('Footer Widget Area 1', 'performance-theme'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer column 1.', 'performance-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
    
    register_sidebar([
        'name'          => __('Footer Widget Area 2', 'performance-theme'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in footer column 2.', 'performance-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'performance_theme_widgets_init');

