<?php
/**
 * The template for displaying all pages
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('vbase-large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'vbase'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>
            </article>

            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();

