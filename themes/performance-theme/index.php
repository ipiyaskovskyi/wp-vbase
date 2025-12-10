<?php
/**
 * The main template file
 *
 * @package Performance_Theme
 */

get_header();
?>

<div class="content-area">
    <div class="container">
        <?php if (have_posts()) : ?>
            
            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', get_post_type());
                endwhile;
                ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => sprintf(
                    '<span class="screen-reader-text">%s</span><span aria-hidden="true">&laquo;</span>',
                    __('Previous', 'performance-theme')
                ),
                'next_text' => sprintf(
                    '<span class="screen-reader-text">%s</span><span aria-hidden="true">&raquo;</span>',
                    __('Next', 'performance-theme')
                ),
            ]);
            ?>
            
        <?php else : ?>
            
            <?php get_template_part('template-parts/content/content', 'none'); ?>
            
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

