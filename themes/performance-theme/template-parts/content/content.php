<?php
/**
 * Template part for displaying posts
 *
 * @package Performance_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        
        <div class="entry-meta">
            <time class="entry-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date()); ?>
            </time>
            <span class="entry-author">
                <?php esc_html_e('by', 'performance-theme'); ?>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php the_author(); ?>
                </a>
            </span>
        </div>
    </header>
    
    <?php if (has_post_thumbnail()) : ?>
        <figure class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('card-thumb', [
                    'loading' => 'lazy',
                    'decoding' => 'async',
                ]); ?>
            </a>
        </figure>
    <?php endif; ?>
    
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    
    <footer class="entry-footer">
        <a href="<?php the_permalink(); ?>" class="read-more">
            <?php esc_html_e('Read More', 'performance-theme'); ?>
            <span class="screen-reader-text"><?php the_title(); ?></span>
        </a>
    </footer>
</article>

