<?php
/**
 * Template part for displaying related posts
 *
 * @package Performance_Theme
 */

$related_posts = performance_theme_related_posts(3);

if (empty($related_posts)) {
    return;
}
?>

<aside class="related-posts" aria-labelledby="related-posts-title">
    <h3 id="related-posts-title" class="related-posts-title">
        <?php esc_html_e('Related Posts', 'performance-theme'); ?>
    </h3>
    
    <div class="related-posts-grid">
        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
            <article class="related-post-card">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="related-post-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('card-thumb', [
                                'loading' => 'lazy',
                                'decoding' => 'async',
                            ]); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="related-post-content">
                    <?php the_title(sprintf('<h4 class="related-post-title"><a href="%s">', esc_url(get_permalink())), '</a></h4>'); ?>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </div>
            </article>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</aside>

