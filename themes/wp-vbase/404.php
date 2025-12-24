<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package VBase
 */

get_header();
?>

<main id="main-content" class="site-main error-404-page">
    <div class="l-container">
        <div class="error-404 not-found">
            <div class="error-404__header">
                <h1 class="error-404__title"><?php esc_html_e('Page not found', 'vbase'); ?></h1>
                <p class="error-404__subtitle"><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'vbase'); ?></p>
            </div>

            <div class="error-404__actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="button button--dark with-arrow">
                    <?php esc_html_e('Go to Home', 'vbase'); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
