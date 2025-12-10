<?php
/**
 * The main template file
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            
            <div class="posts-list">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('vbase-medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </span>
                                    <span class="byline">
                                        <?php esc_html_e('by', 'vbase'); ?> <?php the_author(); ?>
                                    </span>
                                </div>
                            </header>
                            
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e('Read More', 'vbase'); ?>
                                </a>
                            </footer>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => sprintf(
                    '<span class="screen-reader-text">%s</span><span aria-hidden="true">&laquo;</span>',
                    __('Previous', 'vbase')
                ),
                'next_text' => sprintf(
                    '<span class="screen-reader-text">%s</span><span aria-hidden="true">&raquo;</span>',
                    __('Next', 'vbase')
                ),
            ]);
            ?>
            
        <?php else : ?>
            
            <div class="no-posts">
                <h2><?php esc_html_e('Nothing Found', 'vbase'); ?></h2>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'vbase'); ?></p>
            </div>
            
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

