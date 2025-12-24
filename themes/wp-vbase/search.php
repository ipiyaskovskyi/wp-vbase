<?php
/**
 * The template for displaying search results
 *
 * @package VBase
 */

get_header();

// Get blog page URL for breadcrumb
$blog_page_id = get_option('page_for_posts');
$blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
?>

<main id="main-content" class="site-main search-page">
    <div class="l-container">
        <!-- Breadcrumb -->
        <nav class="search-breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'vbase'); ?>">
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
            <span class="breadcrumb-current"><?php esc_html_e('Search Results', 'vbase'); ?></span>
        </nav>

        <?php if (have_posts()) : ?>
            <!-- Page Header -->
            <header class="search-header">
                <h1 class="b-page-title">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'vbase'),
                        '<span class="search-query">' . esc_html(get_search_query()) . '</span>'
                    );
                    ?>
                </h1>
            </header>
            
            <div class="search-posts__grid">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" class="blog-post-card">
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
                ?>
            </div>
            
            <?php
            // Pagination
            global $wp_query;
            if ($wp_query->max_num_pages > 1) {
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $search_query = get_search_query();
                
                $pagination_args = [
                    'base' => home_url('/') . '%_%',
                    'format' => '?s=' . urlencode($search_query) . '&paged=%#%',
                    'current' => max(1, $paged),
                    'total' => $wp_query->max_num_pages,
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
            
        <?php else : ?>
            <div class="error-404 not-found">
                <div class="error-404__header">
                    <h1 class="error-404__title"><?php esc_html_e('Nothing Found', 'vbase'); ?></h1>
                    <p class="error-404__subtitle"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'vbase'); ?></p>
                </div>

                <div class="error-404__actions">
                    <?php
                    $blog_page_id = get_option('page_for_posts');
                    $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
                    ?>
                    <a href="<?php echo esc_url($blog_url); ?>" class="button button--dark with-arrow">
                        <?php esc_html_e('Go to Blog', 'vbase'); ?>
                    </a>
                </div>
            </div>
            
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
