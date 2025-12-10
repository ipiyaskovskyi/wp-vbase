<?php
/**
 * Template part for displaying post cards
 *
 * @package Performance_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-card-image">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('card-thumb', [
                    'loading' => 'lazy',
                    'decoding' => 'async',
                ]); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="post-card-content">
        <?php
        $categories = get_the_category();
        if ($categories) :
        ?>
            <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="post-card-category">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        <?php endif; ?>
        
        <?php the_title(sprintf('<h3 class="post-card-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
        
        <p class="post-card-excerpt">
            <?php echo esc_html(performance_theme_excerpt(20)); ?>
        </p>
        
        <div class="post-card-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date()); ?>
            </time>
            <span><?php echo esc_html(performance_theme_reading_time()); ?></span>
        </div>
    </div>
</article>

