<?php
/**
 * Performance Optimizer Class
 *
 * Handles all performance-related optimizations
 *
 * @package Performance_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class Performance_Optimizer {
    
    private static ?self $instance = null;
    
    public static function get_instance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init_hooks();
    }
    
    private function init_hooks(): void {
        // Output buffering for HTML minification
        add_action('template_redirect', [$this, 'start_output_buffer']);
        add_action('shutdown', [$this, 'end_output_buffer']);
        
        // Optimize database queries
        add_action('pre_get_posts', [$this, 'optimize_queries']);
        
        // Add performance headers
        add_action('send_headers', [$this, 'add_performance_headers']);
        
        // Prefetch DNS for external resources
        add_action('wp_head', [$this, 'dns_prefetch'], 0);
        
        // Defer parsing of JavaScript
        add_filter('script_loader_tag', [$this, 'defer_scripts'], 10, 3);
        
        // Remove query strings from static resources
        add_filter('script_loader_src', [$this, 'remove_query_strings'], 15);
        add_filter('style_loader_src', [$this, 'remove_query_strings'], 15);
        
        // Disable oEmbed
        add_action('init', [$this, 'disable_oembed']);
        
        // Optimize revisions
        add_filter('wp_revisions_to_keep', [$this, 'limit_revisions'], 10, 2);
    }
    
    /**
     * Start output buffering for potential HTML minification
     */
    public function start_output_buffer(): void {
        if (!is_admin() && !is_feed() && !is_robots() && !is_trackback()) {
            ob_start([$this, 'minify_html']);
        }
    }
    
    /**
     * End output buffering
     */
    public function end_output_buffer(): void {
        if (ob_get_level() > 0) {
            ob_end_flush();
        }
    }
    
    /**
     * Minify HTML output
     */
    public function minify_html(string $html): string {
        if (empty($html)) {
            return $html;
        }
        
        // Preserve pre, code, textarea, script content
        $preserved = [];
        $html = preg_replace_callback(
            '/<(pre|code|textarea|script)[^>]*>.*?<\/\1>/is',
            function($matches) use (&$preserved) {
                $placeholder = '<!--PRESERVED' . count($preserved) . '-->';
                $preserved[] = $matches[0];
                return $placeholder;
            },
            $html
        );
        
        // Remove HTML comments (except IE conditionals and preserved)
        $html = preg_replace('/<!--(?!PRESERVED|\[if).*?-->/s', '', $html);
        
        // Remove whitespace between tags
        $html = preg_replace('/>\s+</', '><', $html);
        
        // Reduce multiple spaces to single
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Restore preserved content
        foreach ($preserved as $i => $content) {
            $html = str_replace('<!--PRESERVED' . $i . '-->', $content, $html);
        }
        
        return trim($html);
    }
    
    /**
     * Optimize database queries
     */
    public function optimize_queries(\WP_Query $query): void {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }
        
        // Disable found_rows for performance when pagination not needed
        if ($query->is_singular()) {
            $query->set('no_found_rows', true);
        }
        
        // Optimize archive queries
        if ($query->is_archive() || $query->is_home()) {
            // Only get necessary fields
            $query->set('update_post_meta_cache', false);
            $query->set('update_post_term_cache', false);
        }
    }
    
    /**
     * Add performance headers
     */
    public function add_performance_headers(): void {
        if (headers_sent()) {
            return;
        }
        
        // Enable gzip compression hint
        header('Vary: Accept-Encoding');
        
        // Security headers that also improve performance
        header('X-Content-Type-Options: nosniff');
        header('X-XSS-Protection: 1; mode=block');
        
        // Cache control for dynamic pages
        if (!is_user_logged_in()) {
            header('Cache-Control: public, max-age=3600');
        }
    }
    
    /**
     * Add DNS prefetch hints
     */
    public function dns_prefetch(): void {
        $domains = [
            '//fonts.googleapis.com',
            '//fonts.gstatic.com',
            '//www.google-analytics.com',
            '//www.googletagmanager.com',
        ];
        
        foreach ($domains as $domain) {
            echo '<link rel="dns-prefetch" href="' . esc_url($domain) . '">' . "\n";
        }
    }
    
    /**
     * Defer non-critical scripts
     */
    public function defer_scripts(string $tag, string $handle, string $src): string {
        $defer_scripts = [
            'comment-reply',
            'wp-embed',
        ];
        
        if (in_array($handle, $defer_scripts, true)) {
            return str_replace(' src', ' defer src', $tag);
        }
        
        return $tag;
    }
    
    /**
     * Remove query strings from static resources
     */
    public function remove_query_strings(?string $src): ?string {
        if ($src === null) {
            return null;
        }
        
        if (strpos($src, '?ver=') !== false) {
            $src = remove_query_arg('ver', $src);
        }
        
        return $src;
    }
    
    /**
     * Disable oEmbed functionality
     */
    public function disable_oembed(): void {
        // Remove oEmbed discovery links
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        
        // Remove oEmbed REST API endpoint
        remove_action('rest_api_init', 'wp_oembed_register_route');
        
        // Remove oEmbed filter
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    }
    
    /**
     * Limit post revisions
     */
    public function limit_revisions(int $num, \WP_Post $post): int {
        return 5;
    }
    
    /**
     * Generate srcset for responsive images
     */
    public static function get_responsive_image(int $attachment_id, string $size = 'large', array $attr = []): string {
        $default_attr = [
            'loading' => 'lazy',
            'decoding' => 'async',
        ];
        
        $attr = array_merge($default_attr, $attr);
        
        return wp_get_attachment_image($attachment_id, $size, false, $attr);
    }
    
    /**
     * Get optimized image URL with WebP support
     */
    public static function get_optimized_image_url(int $attachment_id, string $size = 'large'): string {
        $image = wp_get_attachment_image_src($attachment_id, $size);
        
        if (!$image) {
            return '';
        }
        
        $url = $image[0];
        
        // Check for WebP version
        $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $url);
        $webp_path = str_replace(
            wp_get_upload_dir()['baseurl'],
            wp_get_upload_dir()['basedir'],
            $webp_url
        );
        
        if (file_exists($webp_path)) {
            return $webp_url;
        }
        
        return $url;
    }
}

// Initialize
Performance_Optimizer::get_instance();

