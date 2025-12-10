<?php
/**
 * Template Functions
 *
 * Helper functions for templates
 *
 * @package Performance_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Calculate reading time for a post
 */
function performance_theme_reading_time(?int $post_id = null): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assume 200 words per minute
    
    return sprintf(
        _n('%d min read', '%d min read', $reading_time, 'performance-theme'),
        $reading_time
    );
}

/**
 * Get excerpt with custom length
 */
function performance_theme_excerpt(int $length = 20, ?int $post_id = null): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $excerpt = get_the_excerpt($post_id);
    
    if (empty($excerpt)) {
        $content = get_post_field('post_content', $post_id);
        $excerpt = wp_trim_words(strip_shortcodes($content), $length, '...');
    }
    
    return $excerpt;
}

/**
 * Get responsive image with placeholder
 */
function performance_theme_responsive_image(
    int $attachment_id,
    string $size = 'large',
    array $attr = [],
    bool $lazy = true
): string {
    $default_attr = [
        'class' => 'responsive-image',
    ];
    
    if ($lazy) {
        $default_attr['loading'] = 'lazy';
        $default_attr['decoding'] = 'async';
    }
    
    $attr = array_merge($default_attr, $attr);
    
    return wp_get_attachment_image($attachment_id, $size, false, $attr);
}

/**
 * Get placeholder image
 */
function performance_theme_placeholder_image(int $width, int $height, string $class = ''): string {
    $placeholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 {$width} {$height}'%3E%3Crect fill='%23f0f0f0' width='{$width}' height='{$height}'/%3E%3C/svg%3E";
    
    return sprintf(
        '<img src="%s" width="%d" height="%d" alt="" class="%s" aria-hidden="true">',
        esc_attr($placeholder),
        esc_attr($width),
        esc_attr($height),
        esc_attr($class)
    );
}

/**
 * Get post categories as HTML
 */
function performance_theme_post_categories(?int $post_id = null): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    
    if (empty($categories)) {
        return '';
    }
    
    $output = '<div class="post-categories">';
    
    foreach ($categories as $category) {
        $output .= sprintf(
            '<a href="%s" class="category-link" rel="category">%s</a>',
            esc_url(get_category_link($category->term_id)),
            esc_html($category->name)
        );
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Get post tags as HTML
 */
function performance_theme_post_tags(?int $post_id = null): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $tags = get_the_tags($post_id);
    
    if (empty($tags)) {
        return '';
    }
    
    $output = '<div class="post-tags">';
    
    foreach ($tags as $tag) {
        $output .= sprintf(
            '<a href="%s" class="tag-link" rel="tag">%s</a>',
            esc_url(get_tag_link($tag->term_id)),
            esc_html($tag->name)
        );
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Get social share links
 */
function performance_theme_share_links(?int $post_id = null): string {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $url = urlencode(get_permalink($post_id));
    $title = urlencode(get_the_title($post_id));
    
    $networks = [
        'twitter' => [
            'url' => "https://twitter.com/intent/tweet?url={$url}&text={$title}",
            'label' => __('Share on Twitter', 'performance-theme'),
            'icon' => 'twitter',
        ],
        'facebook' => [
            'url' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'label' => __('Share on Facebook', 'performance-theme'),
            'icon' => 'facebook',
        ],
        'linkedin' => [
            'url' => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
            'label' => __('Share on LinkedIn', 'performance-theme'),
            'icon' => 'linkedin',
        ],
    ];
    
    $output = '<div class="share-links">';
    
    foreach ($networks as $network => $data) {
        $output .= sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s" class="share-link share-link--%s">%s</a>',
            esc_url($data['url']),
            esc_attr($data['label']),
            esc_attr($network),
            esc_html(ucfirst($network))
        );
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Get related posts
 */
function performance_theme_related_posts(int $count = 3, ?int $post_id = null): array {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    
    if (empty($categories)) {
        return [];
    }
    
    $category_ids = array_map(function($cat) {
        return $cat->term_id;
    }, $categories);
    
    $args = [
        'posts_per_page' => $count,
        'post__not_in' => [$post_id],
        'category__in' => $category_ids,
        'orderby' => 'rand',
        'no_found_rows' => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ];
    
    return get_posts($args);
}

/**
 * Get pagination
 */
function performance_theme_pagination(): void {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    the_posts_pagination([
        'mid_size' => 2,
        'prev_text' => sprintf(
            '<span class="screen-reader-text">%s</span><svg class="icon" aria-hidden="true"><use xlink:href="#icon-arrow-left"></use></svg>',
            __('Previous', 'performance-theme')
        ),
        'next_text' => sprintf(
            '<span class="screen-reader-text">%s</span><svg class="icon" aria-hidden="true"><use xlink:href="#icon-arrow-right"></use></svg>',
            __('Next', 'performance-theme')
        ),
        'class' => 'pagination',
    ]);
}

/**
 * Check if page is using a specific template
 */
function performance_theme_is_template(string $template): bool {
    return get_page_template_slug() === $template;
}

/**
 * Get SVG icon
 */
function performance_theme_get_icon(string $name, array $attr = []): string {
    $default_attr = [
        'class' => 'icon icon--' . $name,
        'aria-hidden' => 'true',
        'width' => '24',
        'height' => '24',
    ];
    
    $attr = array_merge($default_attr, $attr);
    
    $attr_string = '';
    foreach ($attr as $key => $value) {
        $attr_string .= sprintf(' %s="%s"', esc_attr($key), esc_attr($value));
    }
    
    return sprintf(
        '<svg%s><use xlink:href="#icon-%s"></use></svg>',
        $attr_string,
        esc_attr($name)
    );
}

/**
 * Output inline SVG sprite
 */
function performance_theme_svg_sprite(): void {
    $sprite_file = THEME_DIR . '/assets/images/sprite.svg';
    
    if (file_exists($sprite_file)) {
        echo '<div class="svg-sprite" hidden>' . file_get_contents($sprite_file) . '</div>';
    }
}
add_action('wp_body_open', 'performance_theme_svg_sprite');

