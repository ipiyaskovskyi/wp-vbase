<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <div class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('404 - Page Not Found', 'vbase'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'vbase'); ?></p>
                
                <?php get_search_form(); ?>
                
                <div class="back-home">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                        <?php esc_html_e('Go to Homepage', 'vbase'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();

