<?php
/**
 * The template for displaying single posts
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
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">
                            <?php echo esc_html(get_the_date()); ?>
                        </span>
                        <span class="byline">
                            <?php esc_html_e('by', 'vbase'); ?> <?php the_author(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="cat-links">
                                <?php esc_html_e('in', 'vbase'); ?> <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
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

                <footer class="entry-footer">
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <?php the_tags('<span class="tags-title">' . esc_html__('Tags:', 'vbase') . '</span> ', ', ', ''); ?>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>

            <?php
            // Post navigation
            the_post_navigation([
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'vbase') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'vbase') . '</span> <span class="nav-title">%title</span>',
            ]);

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

