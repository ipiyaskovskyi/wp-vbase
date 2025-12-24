<?php
/**
 * Template for displaying the Blog page
 * This template is used when a static page is set as the posts page
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main blog-page">
    <div class="l-container">
        <!-- Breadcrumb -->
        <nav class="blog-breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'vbase'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <span class="material-icons" aria-hidden="true">home</span>
                <?php esc_html_e('Home', 'vbase'); ?>
            </a>
            <span class="breadcrumb-separator" aria-hidden="true">
                <span class="material-icons">chevron_right</span>
            </span>
            <span><?php esc_html_e('Blog', 'vbase'); ?></span>
        </nav>

        <!-- Page Header -->
        <header class="blog-header u-flex u-justify-between u-items-center">
            <h1 class="b-page-title b-page-title--no-margin"><?php esc_html_e('vBase Blog', 'vbase'); ?></h1>
            <div class="blog-search">
                <?php get_search_form(); ?>
            </div>
        </header>

        <?php
        // Get featured post (first post)
        $featured_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        if ($featured_query->have_posts()) :
            $featured_query->the_post();
            $featured_post_id = get_the_ID();
        ?>
            <!-- Featured Article -->
            <article class="blog-featured u-flex">
                <?php if (has_post_thumbnail()) : 
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                    <div class="blog-featured__image" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>"></a>
                    </div>
                <?php else : ?>
                    <div class="blog-featured__image blog-featured__image--placeholder">
                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>"></a>
                    </div>
                <?php endif; ?>
                <div class="blog-featured__content">
                    <div class="blog-featured__tags">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="blog-tag">' . esc_html(strtoupper($category->name)) . '</a>';
                        }
                        ?>
                    </div>
                    <h2 class="blog-featured__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="blog-featured__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                    <a href="<?php the_permalink(); ?>" class="button button--dark with-arrow blog-featured__link">
                        <?php esc_html_e('Read More', 'vbase'); ?>
                    </a>
                </div>
            </article>

            <?php
            $featured_query->reset_postdata();
            
            // Newsletter Signup Section
            ?>
            <section class="blog-newsletter">
                <div class="blog-newsletter__content">
                    <p class="blog-newsletter__text"><?php esc_html_e('Updates, stories and announcements from the vBase team.', 'vbase'); ?></p>
                    <?php echo do_shortcode('[contact-form-7 id="7e7d1a4" title="Contact form blog"]'); ?>
                </div>
            </section>

            <!-- Recent Posts Grid -->
            <section class="blog-posts">
                <h2 class="blog-posts__title"><?php esc_html_e('Recent Posts', 'vbase'); ?></h2>
                <div class="blog-posts__grid">
            <?php
            // Get current page number
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            
            // Get remaining posts (excluding featured) with pagination
            $grid_posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 6,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => [$featured_post_id],
                'paged' => $paged,
            ]);
            
            if ($grid_posts->have_posts()) :
                while ($grid_posts->have_posts()) :
                    $grid_posts->the_post();
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
                                        if ($category_count < 3) { // Show max 3 categories
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
                else :
                    ?>
                    <div class="no-posts">
                        <p><?php esc_html_e('No additional posts found.', 'vbase'); ?></p>
                    </div>
                <?php endif; ?>
                </div>
                
                <?php
                // Pagination for grid posts
                if ($grid_posts->max_num_pages > 1) {
                    $blog_page_id = get_option('page_for_posts');
                    $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
                    
                    $pagination_args = [
                        'base' => trailingslashit($blog_url) . 'page/%#%/',
                        'format' => 'page/%#%/',
                        'current' => max(1, $paged),
                        'total' => $grid_posts->max_num_pages,
                        'mid_size' => 2,
                        'prev_text' => sprintf(
                            '<span class="screen-reader-text">%s</span><span aria-hidden="true">&laquo;</span>',
                            __('Previous', 'vbase')
                        ),
                        'next_text' => sprintf(
                            '<span class="screen-reader-text">%s</span><span aria-hidden="true">&raquo;</span>',
                            __('Next', 'vbase')
                        ),
                    ];
                    echo '<div class="b-pagination">';
                    echo paginate_links($pagination_args);
                    echo '</div>';
                }
                ?>
            </section>

        <?php else : ?>
            <div class="no-posts">
                <h2><?php esc_html_e('Nothing Found', 'vbase'); ?></h2>
                <p><?php esc_html_e('No posts found.', 'vbase'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

