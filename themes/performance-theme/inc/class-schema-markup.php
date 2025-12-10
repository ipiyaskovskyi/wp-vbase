<?php
/**
 * Schema Markup Class
 *
 * Handles structured data / JSON-LD for SEO
 *
 * @package Performance_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class Schema_Markup {
    
    private static ?self $instance = null;
    
    public static function get_instance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('wp_head', [$this, 'output_schema'], 10);
    }
    
    /**
     * Output schema markup
     */
    public function output_schema(): void {
        $schema = $this->get_schema();
        
        if (!empty($schema)) {
            echo '<script type="application/ld+json">' . "\n";
            echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            echo "\n" . '</script>' . "\n";
        }
    }
    
    /**
     * Get schema based on current page
     */
    private function get_schema(): array {
        $schema = [];
        
        // Website schema (always present)
        $schema[] = $this->get_website_schema();
        
        // Organization schema
        $schema[] = $this->get_organization_schema();
        
        // Page-specific schema
        if (is_singular('post')) {
            $schema[] = $this->get_article_schema();
        } elseif (is_page()) {
            $schema[] = $this->get_webpage_schema();
        } elseif (is_front_page()) {
            $schema[] = $this->get_homepage_schema();
        } elseif (is_author()) {
            $schema[] = $this->get_person_schema();
        }
        
        return array_filter($schema);
    }
    
    /**
     * Website schema
     */
    private function get_website_schema(): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => home_url('/#website'),
            'url' => home_url('/'),
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url('/?s={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }
    
    /**
     * Organization schema
     */
    private function get_organization_schema(): array {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => home_url('/#organization'),
            'name' => get_bloginfo('name'),
            'url' => home_url('/'),
        ];
        
        // Logo
        $logo_id = get_theme_mod('custom_logo');
        if ($logo_id) {
            $logo = wp_get_attachment_image_src($logo_id, 'full');
            if ($logo) {
                $schema['logo'] = [
                    '@type' => 'ImageObject',
                    'url' => $logo[0],
                    'width' => $logo[1],
                    'height' => $logo[2],
                ];
            }
        }
        
        // Social profiles
        $social_profiles = [];
        $social_urls = [
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'linkedin_url',
            'youtube_url',
        ];
        
        foreach ($social_urls as $social) {
            $url = get_theme_mod($social);
            if ($url) {
                $social_profiles[] = $url;
            }
        }
        
        if (!empty($social_profiles)) {
            $schema['sameAs'] = $social_profiles;
        }
        
        return $schema;
    }
    
    /**
     * Article schema for blog posts
     */
    private function get_article_schema(): array {
        $post = get_queried_object();
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            '@id' => get_permalink() . '#article',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => get_permalink(),
            ],
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => [
                '@type' => 'Person',
                'name' => get_the_author(),
                'url' => get_author_posts_url(get_the_author_meta('ID')),
            ],
            'publisher' => [
                '@id' => home_url('/#organization'),
            ],
        ];
        
        // Description
        if (!empty($post->post_excerpt)) {
            $schema['description'] = wp_trim_words($post->post_excerpt, 30, '...');
        } elseif (!empty($post->post_content)) {
            $schema['description'] = wp_trim_words(strip_shortcodes($post->post_content), 30, '...');
        }
        
        // Featured image
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            if ($image) {
                $schema['image'] = [
                    '@type' => 'ImageObject',
                    'url' => $image[0],
                    'width' => $image[1],
                    'height' => $image[2],
                ];
            }
        }
        
        // Word count
        $schema['wordCount'] = str_word_count(strip_tags($post->post_content));
        
        // Categories
        $categories = get_the_category();
        if ($categories) {
            $schema['articleSection'] = array_map(function($cat) {
                return $cat->name;
            }, $categories);
        }
        
        // Tags
        $tags = get_the_tags();
        if ($tags) {
            $schema['keywords'] = implode(', ', array_map(function($tag) {
                return $tag->name;
            }, $tags));
        }
        
        return $schema;
    }
    
    /**
     * WebPage schema for pages
     */
    private function get_webpage_schema(): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => get_permalink() . '#webpage',
            'url' => get_permalink(),
            'name' => get_the_title(),
            'isPartOf' => [
                '@id' => home_url('/#website'),
            ],
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
        ];
    }
    
    /**
     * Homepage schema
     */
    private function get_homepage_schema(): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => home_url('/#homepage'),
            'url' => home_url('/'),
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'isPartOf' => [
                '@id' => home_url('/#website'),
            ],
        ];
    }
    
    /**
     * Person schema for author pages
     */
    private function get_person_schema(): array {
        $author = get_queried_object();
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            '@id' => get_author_posts_url($author->ID) . '#person',
            'name' => $author->display_name,
            'url' => get_author_posts_url($author->ID),
        ];
        
        // Bio
        $bio = get_the_author_meta('description', $author->ID);
        if ($bio) {
            $schema['description'] = $bio;
        }
        
        // Avatar
        $avatar_url = get_avatar_url($author->ID, ['size' => 256]);
        if ($avatar_url) {
            $schema['image'] = [
                '@type' => 'ImageObject',
                'url' => $avatar_url,
            ];
        }
        
        return $schema;
    }
    
    /**
     * FAQ Schema for pages with FAQ blocks
     */
    public static function get_faq_schema(array $faqs): array {
        $questions = [];
        
        foreach ($faqs as $faq) {
            $questions[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $questions,
        ];
    }
    
    /**
     * Product schema
     */
    public static function get_product_schema(array $product): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product['name'],
            'description' => $product['description'] ?? '',
            'image' => $product['image'] ?? '',
            'offers' => [
                '@type' => 'Offer',
                'price' => $product['price'],
                'priceCurrency' => $product['currency'] ?? 'USD',
                'availability' => 'https://schema.org/InStock',
            ],
        ];
    }
}

// Initialize
Schema_Markup::get_instance();

