<?php
/**
 * The template for displaying pages
 *
 * @package Performance_Theme
 */

get_header();
?>

<article id="page-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
    <div class="container container-narrow">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            
            <?php // Featured Image ?>
            <?php if (has_post_thumbnail()) : ?>
                <figure class="entry-featured-image">
                    <?php
                    the_post_thumbnail('hero-large', [
                        'fetchpriority' => 'high',
                        'decoding'      => 'async',
                    ]);
                    ?>
                </figure>
            <?php endif; ?>
            
            <div class="entry-content">
                <?php
                the_content();
                
                wp_link_pages([
                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'performance-theme') . '</span>',
                    'after'  => '</div>',
                ]);
                ?>
            </div>
            
            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
            
        <?php endwhile; ?>
    </div>
</article>

<?php
get_footer();

