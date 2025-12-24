<footer class="footer" role="contentinfo">
    <div class="l-container">
        <div class="row">
            <section class="l-section l-section-sm col-lg-9 col-md-12 col-sm-12 sm:u-items-center sm:u-text-center" aria-labelledby="newsletter-heading">
            <div class="footer__logo u-flex">
                <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="vBase">
                    <img src="<?php echo esc_url(VBASE_URI . '/assets/images/logo-white.svg'); ?>" width="77" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="footer-newsletter">
                <h2 id="newsletter-heading" class="footer__title"><?php esc_html_e('Sign up to our mailing list', 'vbase'); ?></h2>
                <?php
                // Check if Contact Form 7 is active
                if (function_exists('wpcf7')) {
                    echo do_shortcode('[contact-form-7 id="4764d01" title="Contact form footer"]');
                } else {
                    // Simple form if CF7 is not available
                    ?>
                    <form class="footer-newsletter__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="vbase_newsletter_subscribe">
                        <?php wp_nonce_field('vbase_newsletter_nonce', 'vbase_newsletter_nonce'); ?>
                        <div class="footer-newsletter__form-group">
                            <input 
                                type="email" 
                                name="email" 
                                class="footer-newsletter__input" 
                                placeholder="<?php esc_attr_e('Enter your email', 'vbase'); ?>" 
                                required 
                                aria-label="<?php esc_attr_e('Email address', 'vbase'); ?>"
                            >
                            <button type="submit" class="footer-newsletter__submit" aria-label="<?php esc_attr_e('Subscribe', 'vbase'); ?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.33334 8H12.6667M12.6667 8L8.66667 4M12.6667 8L8.66667 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
                <nav class="footer__social" aria-label="<?php esc_attr_e('Social Media Links', 'vbase'); ?>">
                    <a target="_blank" href="https://github.com/validitybase" aria-label="github" rel="noopener">
                        <span>
                        <svg width="32" height="31.21" viewBox="0 0 32 31.21" id="icon-github" xmlns="http://www.w3.org/2000/svg"><g id="Symbols" transform="translate(-2 -2)"><g id="UI_icons_dark_github" data-name="UI/icons/dark/github" transform="translate(2 2)"><path id="icons_icon-github" data-name="icons/icon-github" d="M18,2a16,16,0,0,0-5.057,31.182c.8.147,1.092-.347,1.092-.771,0-.38-.014-1.386-.022-2.721-4.45.967-5.389-2.145-5.389-2.145A4.238,4.238,0,0,0,6.846,25.2c-1.453-.992.11-.972.11-.972a3.359,3.359,0,0,1,2.451,1.649,3.407,3.407,0,0,0,4.657,1.329,3.42,3.42,0,0,1,1.016-2.138c-3.553-.4-7.288-1.777-7.288-7.908A6.184,6.184,0,0,1,9.438,12.87,5.749,5.749,0,0,1,9.6,8.636s1.343-.43,4.4,1.64a15.146,15.146,0,0,1,8.011,0c3.055-2.071,4.4-1.64,4.4-1.64a5.75,5.75,0,0,1,.16,4.234,6.173,6.173,0,0,1,1.644,4.293c0,6.147-3.741,7.5-7.3,7.9a3.821,3.821,0,0,1,1.085,2.962c0,2.139-.02,3.865-.02,4.39,0,.428.289.926,1.1.77A16,16,0,0,0,18,2" transform="translate(-2 -2)" fill-rule="evenodd"></path></g></g></svg>
                        </span>
                    </a>
                    <a target="_blank" href="https://www.linkedin.com/company/validitybase/" aria-label="linkedin" rel="noopener">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31.983" viewBox="0 0 32 31.983">
                                <use xlink:href="#icon-linkedin"></use>
                            </svg>
                        </span>
                    </a>
                    <a target="_blank" href="https://x.com/validitybase" aria-label="twitter" rel="noopener">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31.985" viewBox="0 0 32 31.985">
                                <use xlink:href="#icon-x"></use>
                            </svg>
                        </span>
                    </a>
                    <a target="_blank" href="https://discord.gg/qjQcCNEBAh" aria-label="discord" rel="noopener">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31.984" viewBox="0 0 32 31.984">
                                <use xlink:href="#icon-discord"></use>
                            </svg>
                        </span>
                    </a>
                </nav>
            </section>
            <section class="l-section l-section-sm col-lg-3 col-md-12 col-sm-12 sm:u-items-center sm:u-text-center" aria-labelledby="products-heading">
                <h2 id="products-heading" class="footer__title"><?php esc_html_e('Products', 'vbase'); ?></h2>
                <nav class="footer__menu" aria-label="<?php esc_attr_e('Products Menu', 'vbase'); ?>">
                    <a href="<?php echo esc_url(home_url('/alt-data/')); ?>">
                        <?php esc_html_e('validityBase for Alternative Data', 'vbase'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/signals/')); ?>">
                        <?php esc_html_e('validityBase for Signals', 'vbase'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/track-record/')); ?>">
                        <?php esc_html_e('validityBase for Track Records', 'vbase'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/predictive-data/')); ?>">
                        <?php esc_html_e('validityBase for Predictive Data', 'vbase'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/vbase-blockchain-notary/')); ?>" target="_blank" rel="noopener">
                        <?php esc_html_e('The World\'s Simplest Blockchain Notary', 'vbase'); ?>
                    </a>
                </nav>
            </section>
        </div>
        <section class="l-section l-section-lg l-section-border-top l-section-border-top-lg u-flex u-justify-between u-items-center u-flex-wrap u-gap-2xl md:u-gap-lg" aria-labelledby="footer-legal-heading">
            <h2 id="footer-legal-heading" class="screen-reader-text"><?php esc_html_e( 'Legal information', 'vbase' ); ?></h2>
            <nav class="footer__terms" aria-label="<?php esc_attr_e('Legal Links', 'vbase'); ?>">
                <ul>
                    <li>
                        <a href="<?php echo esc_url(home_url('/terms-of-service/')); ?>"><?php esc_html_e('Terms of Service', 'vbase'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'vbase'); ?></a>
                    </li>
                </ul>
            </nav>
            <div class="footer__copyright">
                &copy; <?php echo esc_html(date('Y')); ?> validityBase. <?php esc_html_e('All rights reserved.', 'vbase'); ?>
            </div>
        </section>
    </div>
</footer>

<?php
class VBase_Walker_Footer_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
            $classes[] = 'is-active';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names .'>';
        
        $attributes = ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
        
        $item_output = '<a' . $attributes .'>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

class VBase_Walker_Mobile_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= '<li' . $class_names .'>';
        
        $attributes = ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
        
        $item_output = '<a' . $attributes .'>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= '</a>';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>

<?php wp_footer(); ?>

</body>
</html>

