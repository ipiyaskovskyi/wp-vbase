<?php
/**
 * The template for displaying single posts
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main single-post-main">
    <div class="l-container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            
            <?php
            // Breadcrumb Navigation
            $blog_page_id = get_option('page_for_posts');
            $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
            ?>
            <nav class="single-post-breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'vbase'); ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <span class="material-icons" aria-hidden="true">home</span>
                    <?php esc_html_e('Home', 'vbase'); ?>
                </a>
                <span class="breadcrumb-separator" aria-hidden="true">
                    <span class="material-icons">chevron_right</span>
                </span>
                <a href="<?php echo esc_url($blog_url); ?>"><?php esc_html_e('Blog', 'vbase'); ?></a>
                <span class="breadcrumb-separator" aria-hidden="true">
                    <span class="material-icons">chevron_right</span>
                </span>
                <span class="breadcrumb-current"><?php the_title(); ?></span>
            </nav>

            <div class="single-post-wrapper">
                <div class="single-post-content">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                        <header class="single-post-header">
                            <h1 class="b-page-title"><?php the_title(); ?></h1>
                            <div class="single-post-author">
                                <span class="author-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 8C10.2091 8 12 6.20914 12 4C12 1.79086 10.2091 0 8 0C5.79086 0 4 1.79086 4 4C4 6.20914 5.79086 8 8 8Z" fill="currentColor"/>
                                        <path d="M8 10C4.68629 10 2 12.6863 2 16H14C14 12.6863 11.3137 10 8 10Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                <span class="author-name"><?php the_author(); ?></span>
                            </div>
                        </header>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-post-thumbnail">
                                <?php the_post_thumbnail('vbase-large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="single-post-entry-content entry-content">
                            <?php
                            the_content();
                            
                            wp_link_pages([
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'vbase'),
                                'after'  => '</div>',
                            ]);
                            ?>
                        </div>
                        </footer>
                    </article>
                </div>

                <aside class="single-post-sidebar">
                    <?php
                    // Search Form
                    ?>
                    <div class="single-post-sidebar-search widget">
                        <h3 class="widget-title screen-reader-text"><?php esc_html_e('Search', 'vbase'); ?></h3>
                        <div class="single-search">
                            <?php get_search_form(); ?>
                        </div>
                    </div>

                    <?php
                    // Categories/Topics
                    $categories = get_the_category();
                    if ($categories) :
                        ?>
                        <div class="single-post-sidebar-tags widget">
                            <h3 class="widget-title screen-reader-text"><?php esc_html_e('Topics', 'vbase'); ?></h3>
                            <div class="single-post-tags-list">
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="single-post-tag">
                                        <?php echo esc_html(strtoupper($category->name)); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Newsletter Signup
                    ?>
                    <div class="single-post-sidebar-newsletter widget">
                        <h3 class="widget-title screen-reader-text"><?php esc_html_e('Newsletter', 'vbase'); ?></h3>
                        <div class="single-post-newsletter-box">
                            <p class="single-post-newsletter-text">
                                <?php esc_html_e('Updates, stories and announcements from the vBase team.', 'vbase'); ?>
                            </p>
                            <?php
                            // Contact Form 7
                            if (function_exists('wpcf7')) {
                                echo do_shortcode('[contact-form-7 id="feb24c6" title="Contact form blog side"]');
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    // Recent Posts
                    $recent_posts = new WP_Query([
                        'posts_per_page' => 4,
                        'post__not_in' => [get_the_ID()],
                        'ignore_sticky_posts' => true,
                    ]);
                    
                    if ($recent_posts->have_posts()) :
                        ?>
                        <div class="single-post-sidebar-recent widget">
                            <h3 class="widget-title"><?php esc_html_e('Recent Posts', 'vbase'); ?></h3>
                            <ul class="single-post-recent-list">
                                <?php
                                while ($recent_posts->have_posts()) :
                                    $recent_posts->the_post();
                                    ?>
                                    <li class="single-post-recent-item">
                                        <a href="<?php the_permalink(); ?>" class="single-post-recent-link">
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Social Media Share Icons
                    $post_url = get_permalink();
                    $post_title = get_the_title();
                    $post_excerpt = get_the_excerpt() ? wp_trim_words(get_the_excerpt(), 20) : $post_title;
                    $linkedin_url = 'https://www.linkedin.com/shareArticle?url=' . urlencode($post_url);
                    $twitter_url = 'https://twitter.com/share?url=' . urlencode($post_url) . '&text=' . urlencode($post_excerpt);
                    ?>
                    <div class="single-post-sidebar-social widget">
                        <h3 class="widget-title screen-reader-text"><?php esc_html_e('Social Media', 'vbase'); ?></h3>
                        <nav class="single-post-social-nav" aria-label="<?php esc_attr_e('Social Media Share Links', 'vbase'); ?>">
                            <a href="<?php echo esc_url($linkedin_url); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=550,height=235');return false;" aria-label="linkedin">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31.983" viewBox="0 0 32 31.983" fill="currentColor">
                                    <use xlink:href="#icon-linkedin" fill="currentColor"></use>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url($twitter_url); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" aria-label="twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31.985" viewBox="0 0 32 31.985" fill="currentColor">
                                    <use xlink:href="#icon-x" fill="currentColor"></use>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" target="_blank" aria-label="RSS Feed">
                                <svg style="bottom: 2px; position: relative;" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 32 32">
                                    <circle cx="6" cy="28" r="2" fill="#89938F"></circle>
                                    <circle cx="6" cy="28" r="10" fill="none" stroke="#89938F" stroke-width="2"></circle>
                                    <circle cx="6" cy="28" r="20" fill="none" stroke="#89938F" stroke-width="2"></circle>
                                </svg>
                            </a>
                            <a href="https://github.com/validityBase" target="_blank" aria-label="vBase">
                                <svg fill="#89938F" xmlns="http://www.w3.org/2000/svg" viewBox="15 12 43 50" width="34" height="34">
                                    <path d="M36,12c13.255,0,24,10.745,24,24c0,10.656-6.948,19.685-16.559,22.818c0.003-0.009,0.007-0.022,0.007-0.022	s-1.62-0.759-1.586-2.114c0.038-1.491,0-4.971,0-6.248c0-2.193-1.388-3.747-1.388-3.747s10.884,0.122,10.884-11.491	c0-4.481-2.342-6.812-2.342-6.812s1.23-4.784-0.426-6.812c-1.856-0.2-5.18,1.774-6.6,2.697c0,0-2.25-0.922-5.991-0.922	c-3.742,0-5.991,0.922-5.991,0.922c-1.419-0.922-4.744-2.897-6.6-2.697c-1.656,2.029-0.426,6.812-0.426,6.812	s-2.342,2.332-2.342,6.812c0,11.613,10.884,11.491,10.884,11.491s-1.097,1.239-1.336,3.061c-0.76,0.258-1.877,0.576-2.78,0.576	c-2.362,0-4.159-2.296-4.817-3.358c-0.649-1.048-1.98-1.927-3.221-1.927c-0.817,0-1.216,0.409-1.216,0.876s1.146,0.793,1.902,1.659	c1.594,1.826,1.565,5.933,7.245,5.933c0.617,0,1.876-0.152,2.823-0.279c-0.006,1.293-0.007,2.657,0.013,3.454	c0.034,1.355-1.586,2.114-1.586,2.114s0.004,0.013,0.007,0.022C18.948,55.685,12,46.656,12,36C12,22.745,22.745,12,36,12z"></path>
                                </svg>
                            </a>
                        </nav>
                    </div>

                    <?php
                    // Fallback to standard sidebar widgets
                    if (is_active_sidebar('sidebar-1')) {
                        dynamic_sidebar('sidebar-1');
                    }
                    ?>
                </aside>
            </div>

            <?php
            // Recent Posts section at the end of single post
            $recent_posts_grid = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'ignore_sticky_posts' => true,
                'orderby' => 'date',
                'order' => 'DESC',
            ]);
            
            if ($recent_posts_grid->have_posts()) :
                ?>
                <section class="blog-posts">
                    <h1 class="b-page-title"><?php esc_html_e('vBase Blog', 'vbase'); ?></h1>
                    <h2 class="blog-posts__title"><?php esc_html_e('Recent Posts', 'vbase'); ?></h2>
                    <div class="blog-posts__grid">
                        <?php
                        while ($recent_posts_grid->have_posts()) :
                            $recent_posts_grid->the_post();
                            ?>
                            <article class="blog-post-card">
                                <a href="<?php the_permalink(); ?>" class="blog-post-card__link" aria-label="<?php the_title_attribute(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'blog-post-card__image', 'loading' => 'lazy']); ?>
                                    <?php else : ?>
                                        <div class="blog-post-card__image blog-post-card__image--placeholder"></div>
                                    <?php endif; ?>
                                </a>
                                <div class="blog-post-card__content">
                                    <h3 class="blog-post-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="blog-post-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                                    <div class="blog-post-card__tags">
                                        <?php
                                        $categories = get_the_category();
                                        $category_count = 0;
                                        foreach ($categories as $category) {
                                            if ($category_count < 3) {
                                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="blog-tag blog-tag--small">' . esc_html(strtoupper($category->name)) . '</a>';
                                                $category_count++;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
            endif;
            ?>

            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();

