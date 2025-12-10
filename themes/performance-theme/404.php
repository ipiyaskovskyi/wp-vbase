<?php
/**
 * The template for displaying 404 pages
 *
 * @package Performance_Theme
 */

get_header();
?>

<div class="error-404 not-found">
    <div class="container container-narrow">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('404', 'performance-theme'); ?></h1>
            <p class="page-subtitle"><?php esc_html_e('Page Not Found', 'performance-theme'); ?></p>
        </header>
        
        <div class="page-content">
            <p><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'performance-theme'); ?></p>
            
            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Go to Homepage', 'performance-theme'); ?>
                </a>
            </div>
            
            <div class="error-search">
                <p><?php esc_html_e('Or try searching:', 'performance-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

