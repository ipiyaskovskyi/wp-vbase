<?php
/**
 * Search Form Template
 *
 * @package Performance_Theme
 */

$unique_id = wp_unique_id('search-form-');
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'performance-theme'); ?>
    </label>
    <div class="search-form-inner">
        <input 
            type="search" 
            id="<?php echo esc_attr($unique_id); ?>" 
            class="search-field" 
            placeholder="<?php esc_attr_e('Search...', 'performance-theme'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s"
        >
        <button type="submit" class="search-submit btn btn-primary">
            <span class="screen-reader-text"><?php esc_html_e('Search', 'performance-theme'); ?></span>
            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
    </div>
</form>

