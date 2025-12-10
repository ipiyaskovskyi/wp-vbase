<?php
/**
 * The template for displaying search results
 *
 * @package Performance_Theme
 */

get_header();
?>

<div class="search-results">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__('Search Results for: %s', 'performance-theme'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>
        
        <?php if (have_posts()) : ?>
            
            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', 'card');
                endwhile;
                ?>
            </div>
            
            <?php performance_theme_pagination(); ?>
            
        <?php else : ?>
            
            <?php get_template_part('template-parts/content/content', 'none'); ?>
            
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

