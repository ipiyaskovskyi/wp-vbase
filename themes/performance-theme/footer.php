</main><!-- #main-content -->

<footer id="site-footer" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-inner">
            <?php // Footer Widgets ?>
            <div class="footer-widgets">
                <div class="footer-widget-area">
                    <div class="site-branding">
                        <div class="site-logo-icon"></div>
                        <span class="site-title"><?php bloginfo('name'); ?></span>
                    </div>
                    <p style="margin-top: 1rem; font-size: 0.875rem; color: var(--color-text-muted);">
                        <?php bloginfo('description'); ?>
                    </p>
                </div>
                
                <div class="footer-widget-area">
                    <h4 class="widget-title"><?php esc_html_e('Solutions', 'performance-theme'); ?></h4>
                    <ul>
                        <li><a href="#"><?php esc_html_e('Expense Tracking', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Invoicing & Billing', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Tax Management', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Financial Reporting', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Real-Time Analytics', 'performance-theme'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-widget-area">
                    <h4 class="widget-title"><?php esc_html_e('Business Types', 'performance-theme'); ?></h4>
                    <ul>
                        <li><a href="#"><?php esc_html_e('Freelancers', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Small Businesses', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('E-commerce', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Consultants', 'performance-theme'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-widget-area">
                    <h4 class="widget-title"><?php esc_html_e('Resources', 'performance-theme'); ?></h4>
                    <ul>
                        <li><a href="#"><?php esc_html_e('Help Center', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Blog & Articles', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Video Tutorials', 'performance-theme'); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer-widget-area">
                    <h4 class="widget-title"><?php esc_html_e('Community', 'performance-theme'); ?></h4>
                    <ul>
                        <li><a href="#"><?php esc_html_e('Blog', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Academy', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Teaching', 'performance-theme'); ?></a></li>
                        <li><a href="#"><?php esc_html_e('Refer a Friend', 'performance-theme'); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <?php // Footer Bottom ?>
            <div class="site-info">
                <div class="footer-bottom">
                    <p>
                        &copy; <?php echo esc_html(date('Y')); ?> 
                        <?php bloginfo('name'); ?>. 
                        <?php esc_html_e('All rights reserved.', 'performance-theme'); ?>
                    </p>
                    <div class="footer-links">
                        <a href="#"><?php esc_html_e('Privacy Policy', 'performance-theme'); ?></a>
                        <a href="#"><?php esc_html_e('Terms of Use', 'performance-theme'); ?></a>
                        <a href="#"><?php esc_html_e('Disclosure', 'performance-theme'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
