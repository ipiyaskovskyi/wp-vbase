<?php
/**
 * SEO Manager Class
 *
 * Handles all SEO-related optimizations
 *
 * @package Performance_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class SEO_Manager {
    
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
        // Meta tags
        add_action('wp_head', [$this, 'output_meta_tags'], 1);
        
        // Open Graph tags
        add_action('wp_head', [$this, 'output_og_tags'], 5);
        
        // Twitter Card tags
        add_action('wp_head', [$this, 'output_twitter_tags'], 5);
        
        // Canonical URL
        add_action('wp_head', [$this, 'output_canonical'], 5);
        
        // Robots meta
        add_action('wp_head', [$this, 'output_robots_meta'], 5);
        
        // Sitemap
        add_action('init', [$this, 'register_sitemap']);
    }
    
    /**
     * Output basic meta tags
     */
    public function output_meta_tags(): void {
        $description = $this->get_meta_description();
        
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
        
        // Mobile optimization
        echo '<meta name="format-detection" content="telephone=no">' . "\n";
        
        // Theme color
        $theme_color = get_theme_mod('theme_color', '#000000');
        echo '<meta name="theme-color" content="' . esc_attr($theme_color) . '">' . "\n";
    }
    
    /**
     * Get meta description
     */
    private function get_meta_description(): string {
        if (is_singular()) {
            $post = get_queried_object();
            
            // Check for custom excerpt
            if (!empty($post->post_excerpt)) {
                return wp_trim_words($post->post_excerpt, 30, '...');
            }
            
            // Use content excerpt
            if (!empty($post->post_content)) {
                return wp_trim_words(strip_shortcodes($post->post_content), 30, '...');
            }
        }
        
        if (is_category() || is_tag() || is_tax()) {
            $term = get_queried_object();
            if (!empty($term->description)) {
                return wp_trim_words($term->description, 30, '...');
            }
        }
        
        if (is_author()) {
            $author = get_queried_object();
            $bio = get_the_author_meta('description', $author->ID);
            if (!empty($bio)) {
                return wp_trim_words($bio, 30, '...');
            }
        }
        
        // Default site description
        return get_bloginfo('description');
    }
    
    /**
     * Output Open Graph tags
     */
    public function output_og_tags(): void {
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">' . "\n";
        
        if (is_singular()) {
            $post = get_queried_object();
            
            echo '<meta property="og:type" content="article">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
            
            $description = $this->get_meta_description();
            if ($description) {
                echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            }
            
            // Featured image
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                if ($image) {
                    echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
                    echo '<meta property="og:image:width" content="' . esc_attr($image[1]) . '">' . "\n";
                    echo '<meta property="og:image:height" content="' . esc_attr($image[2]) . '">' . "\n";
                }
            }
            
            // Article specific
            echo '<meta property="article:published_time" content="' . esc_attr(get_the_date('c')) . '">' . "\n";
            echo '<meta property="article:modified_time" content="' . esc_attr(get_the_modified_date('c')) . '">' . "\n";
            echo '<meta property="article:author" content="' . esc_attr(get_author_posts_url(get_the_author_meta('ID'))) . '">' . "\n";
            
        } else {
            echo '<meta property="og:type" content="website">' . "\n";
            echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '">' . "\n";
            echo '<meta property="og:url" content="' . esc_url(home_url($_SERVER['REQUEST_URI'])) . '">' . "\n";
            
            $description = $this->get_meta_description();
            if ($description) {
                echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
            }
        }
    }
    
    /**
     * Output Twitter Card tags
     */
    public function output_twitter_tags(): void {
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        
        $twitter_handle = get_theme_mod('twitter_handle', '');
        if ($twitter_handle) {
            echo '<meta name="twitter:site" content="@' . esc_attr($twitter_handle) . '">' . "\n";
        }
        
        if (is_singular()) {
            echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
            
            $description = $this->get_meta_description();
            if ($description) {
                echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
            }
            
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                if ($image) {
                    echo '<meta name="twitter:image" content="' . esc_url($image[0]) . '">' . "\n";
                }
            }
        }
    }
    
    /**
     * Output canonical URL
     */
    public function output_canonical(): void {
        if (is_singular()) {
            echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
        } elseif (is_front_page()) {
            echo '<link rel="canonical" href="' . esc_url(home_url('/')) . '">' . "\n";
        } elseif (is_category() || is_tag() || is_tax()) {
            $term = get_queried_object();
            echo '<link rel="canonical" href="' . esc_url(get_term_link($term)) . '">' . "\n";
        }
    }
    
    /**
     * Output robots meta tag
     */
    public function output_robots_meta(): void {
        $robots = [];
        
        // Don't index search results, archives, etc.
        if (is_search() || is_404()) {
            $robots[] = 'noindex';
            $robots[] = 'follow';
        }
        
        // Pagination
        if (is_paged()) {
            $robots[] = 'noindex';
            $robots[] = 'follow';
        }
        
        if (!empty($robots)) {
            echo '<meta name="robots" content="' . esc_attr(implode(', ', $robots)) . '">' . "\n";
        }
    }
    
    /**
     * Register XML Sitemap
     */
    public function register_sitemap(): void {
        // WordPress 5.5+ has built-in sitemaps
        // This is for additional customization
        add_filter('wp_sitemaps_posts_query_args', [$this, 'sitemap_posts_query']);
    }
    
    /**
     * Customize sitemap posts query
     */
    public function sitemap_posts_query(array $args): array {
        // Exclude password protected posts
        $args['has_password'] = false;
        
        return $args;
    }
    
    /**
     * Generate breadcrumbs
     */
    public static function breadcrumbs(): void {
        if (is_front_page()) {
            return;
        }
        
        $separator = '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        
        echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'performance-theme') . '">';
        echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
        
        $position = 1;
        
        // Home
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/')) . '">';
        echo '<span itemprop="name">' . esc_html__('Home', 'performance-theme') . '</span>';
        echo '</a>';
        echo '<meta itemprop="position" content="' . $position++ . '">';
        echo '</li>';
        echo $separator;
        
        if (is_singular()) {
            $post = get_queried_object();
            
            // Categories for posts
            if (is_single() && get_post_type() === 'post') {
                $categories = get_the_category();
                if ($categories) {
                    $category = $categories[0];
                    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                    echo '<a itemprop="item" href="' . esc_url(get_category_link($category->term_id)) . '">';
                    echo '<span itemprop="name">' . esc_html($category->name) . '</span>';
                    echo '</a>';
                    echo '<meta itemprop="position" content="' . $position++ . '">';
                    echo '</li>';
                    echo $separator;
                }
            }
            
            // Current page
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html(get_the_title()) . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '">';
            echo '</li>';
            
        } elseif (is_category()) {
            $category = get_queried_object();
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($category->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '">';
            echo '</li>';
            
        } elseif (is_tag()) {
            $tag = get_queried_object();
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($tag->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '">';
            echo '</li>';
            
        } elseif (is_search()) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html__('Search Results', 'performance-theme') . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '">';
            echo '</li>';
        }
        
        echo '</ol>';
        echo '</nav>';
    }
}

// Initialize
SEO_Manager::get_instance();

