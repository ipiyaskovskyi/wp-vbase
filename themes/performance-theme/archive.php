<?php
/**
 * The template for displaying archive pages
 *
 * @package Performance_Theme
 */

get_header();
?>

<div class="archive-page">
    <div class="container">
        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
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

