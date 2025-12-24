<?php
/**
 * Template for displaying search form
 *
 * @package VBase
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e('Search for:', 'vbase'); ?></span>
        <input 
            type="search" 
            class="search-field" 
            placeholder="<?php esc_attr_e('Search', 'vbase'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
    </label>
    <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Search', 'vbase'); ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
            <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
</form>

