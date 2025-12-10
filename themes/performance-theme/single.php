<?php
/**
 * The template for displaying single posts
 *
 * @package Performance_Theme
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <div class="container container-narrow">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <header class="entry-header">
                <?php // Category ?>
                <div class="entry-meta-top">
                    <?php
                    $categories = get_the_category();
                    if ($categories) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="entry-category">
                            <?php echo esc_html($categories[0]->name); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
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
                    <span class="entry-reading-time">
                        <?php echo esc_html(performance_theme_reading_time()); ?>
                    </span>
                </div>
            </header>
            
            <?php // Featured Image ?>
            <?php if (has_post_thumbnail()) : ?>
                <figure class="entry-featured-image">
                    <?php
                    the_post_thumbnail('hero-large', [
                        'fetchpriority' => 'high',
                        'decoding'      => 'async',
                        'sizes'         => '(max-width: 768px) 100vw, (max-width: 1200px) 80vw, 800px',
                    ]);
                    ?>
                    <?php if (get_the_post_thumbnail_caption()) : ?>
                        <figcaption class="wp-caption-text">
                            <?php echo esc_html(get_the_post_thumbnail_caption()); ?>
                        </figcaption>
                    <?php endif; ?>
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
            
            <footer class="entry-footer">
                <?php // Tags ?>
                <?php $tags = get_the_tags(); ?>
                <?php if ($tags) : ?>
                    <div class="entry-tags">
                        <span class="tags-label"><?php esc_html_e('Tags:', 'performance-theme'); ?></span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" rel="tag">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <?php // Share Buttons ?>
                <div class="entry-share">
                    <span class="share-label"><?php esc_html_e('Share:', 'performance-theme'); ?></span>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       aria-label="<?php esc_attr_e('Share on Twitter', 'performance-theme'); ?>">
                        Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       aria-label="<?php esc_attr_e('Share on LinkedIn', 'performance-theme'); ?>">
                        LinkedIn
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       aria-label="<?php esc_attr_e('Share on Facebook', 'performance-theme'); ?>">
                        Facebook
                    </a>
                </div>
            </footer>
            
            <?php // Author Box ?>
            <aside class="author-box">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>
                <div class="author-info">
                    <h4 class="author-name">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                            <?php the_author(); ?>
                        </a>
                    </h4>
                    <?php if (get_the_author_meta('description')) : ?>
                        <p class="author-bio"><?php echo esc_html(get_the_author_meta('description')); ?></p>
                    <?php endif; ?>
                </div>
            </aside>
            
            <?php // Post Navigation ?>
            <nav class="post-navigation" aria-label="<?php esc_attr_e('Post navigation', 'performance-theme'); ?>">
                <?php
                the_post_navigation([
                    'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'performance-theme') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . __('Next:', 'performance-theme') . '</span> <span class="nav-title">%title</span>',
                ]);
                ?>
            </nav>
            
            <?php // Related Posts ?>
            <?php get_template_part('template-parts/content/related', 'posts'); ?>
            
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

