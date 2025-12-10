<?php
/**
 * The front page template - Finovance Style
 *
 * @package Performance_Theme
 */

get_header();
?>

<?php // Hero Section ?>
<section class="hero-section" aria-labelledby="hero-title">
    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">
                ✨ <?php echo esc_html(get_theme_mod('hero_badge', __('Effortless Solutions', 'performance-theme'))); ?>
            </span>
            
            <h1 id="hero-title" class="hero-title">
                <?php echo esc_html(get_theme_mod('hero_title', __('Smart finance tools for individuals and growing small businesses.', 'performance-theme'))); ?>
            </h1>
            
            <p class="hero-subtitle">
                <?php echo esc_html(get_theme_mod('hero_subtitle', __('Effortless financial management designed to empower individuals and small businesses with clarity, speed, and reliable growth tools.', 'performance-theme'))); ?>
            </p>
            
            <div class="hero-actions">
                <?php if (get_theme_mod('hero_cta_text', 'Try Demo')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('hero_cta_url', '#')); ?>" class="btn btn-primary btn-large">
                        <?php echo esc_html(get_theme_mod('hero_cta_text', 'Try Demo')); ?>
                    </a>
                <?php endif; ?>
                
                <a href="<?php echo esc_url(get_theme_mod('hero_secondary_url', '#')); ?>" class="btn btn-white btn-large btn-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <?php echo esc_html(get_theme_mod('hero_secondary_text', 'Watch Tutorial')); ?>
                </a>
            </div>
        </div>
        
        <?php // Trust Badges ?>
        <div class="trust-section">
            <p class="trust-label">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <?php esc_html_e('TRUSTED BY COMPANIES ACROSS THE WORLD', 'performance-theme'); ?>
            </p>
            <div class="trust-logos">
                <svg viewBox="0 0 100 32" width="60" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="24" fill="#1a3a2f">VISA</text></svg>
                <svg viewBox="0 0 100 32" width="60" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="24" fill="#1a3a2f">ebay</text></svg>
                <svg viewBox="0 0 100 32" width="60" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="24" fill="#1a3a2f">knab</text></svg>
                <svg viewBox="0 0 100 32" width="80" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="20" fill="#1a3a2f">cansaas</text></svg>
                <svg viewBox="0 0 100 32" width="80" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="20" fill="#1a3a2f">PayPal</text></svg>
                <svg viewBox="0 0 100 32" width="70" height="24"><text x="0" y="24" font-family="Arial" font-weight="bold" font-size="20" fill="#1a3a2f">Pay</text></svg>
            </div>
        </div>
    </div>
</section>

<?php // Features Section ?>
<section class="features-section" aria-labelledby="features-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><?php esc_html_e('Features', 'performance-theme'); ?></span>
            <h2 id="features-title" class="section-title">
                <?php echo esc_html(get_theme_mod('features_title', __('Everything you need to manage finances', 'performance-theme'))); ?>
            </h2>
            <p class="section-description">
                <?php echo esc_html(get_theme_mod('features_description', __('Powerful tools designed to help you grow your business.', 'performance-theme'))); ?>
            </p>
        </div>
        
        <div class="features-grid">
            <?php
            $default_features = [
                [
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>',
                    'title' => 'SmartPay Access',
                    'description' => 'Enjoy perks and rewards minus the pitfalls. Designed with clarity, built for simplicity—credit redefined.',
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                    'title' => 'Capital Control',
                    'description' => 'Access top-tier investment strategies—active portfolio management without complexity.',
                ],
                [
                    'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>',
                    'title' => 'Finance Hub',
                    'description' => 'Say goodbye to outdated banking. Take control with a sleek, mobile-first tool.',
                ],
            ];
            
            for ($i = 1; $i <= 3; $i++) :
                $feature_title = get_theme_mod("feature_{$i}_title", $default_features[$i-1]['title'] ?? '');
                $feature_desc = get_theme_mod("feature_{$i}_description", $default_features[$i-1]['description'] ?? '');
                $feature_icon = get_theme_mod("feature_{$i}_icon", $default_features[$i-1]['icon'] ?? '');
                
                if ($feature_title) :
            ?>
                <article class="feature-card">
                    <?php if ($feature_icon) : ?>
                        <div class="feature-icon">
                            <?php echo $feature_icon; ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="feature-title"><?php echo esc_html($feature_title); ?></h3>
                    <?php if ($feature_desc) : ?>
                        <p class="feature-description"><?php echo esc_html($feature_desc); ?></p>
                    <?php endif; ?>
                </article>
            <?php
                endif;
            endfor;
            ?>
        </div>
    </div>
</section>

<?php // Pricing Section ?>
<section class="pricing-section" aria-labelledby="pricing-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><?php esc_html_e('Pricing', 'performance-theme'); ?></span>
            <h2 id="pricing-title" class="section-title">
                <?php esc_html_e('Scale with Confidence', 'performance-theme'); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e('Choose the plan that fits your needs.', 'performance-theme'); ?>
            </p>
        </div>
        
        <div class="pricing-grid">
            <?php // Starter Plan ?>
            <div class="pricing-card">
                <div class="pricing-header">
                    <p class="pricing-name"><?php esc_html_e('Starter', 'performance-theme'); ?></p>
                    <p class="pricing-price">$19<span>/Month</span></p>
                </div>
                <ul class="pricing-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Create and send unlimited invoices', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Track income and expenses', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Basic reporting dashboard', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Single-user access', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Connect one bank account', 'performance-theme'); ?>
                    </li>
                </ul>
                <a href="#" class="btn btn-outline"><?php esc_html_e('Try Demo', 'performance-theme'); ?></a>
            </div>
            
            <?php // Professional Plan ?>
            <div class="pricing-card featured">
                <div class="pricing-header">
                    <p class="pricing-name"><?php esc_html_e('Professional', 'performance-theme'); ?></p>
                    <p class="pricing-price">$49<span>/Month</span></p>
                </div>
                <ul class="pricing-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Everything in Starter', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Multi-currency support', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Advanced analytics', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Up to 5 team members', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Priority support', 'performance-theme'); ?>
                    </li>
                </ul>
                <a href="#" class="btn btn-accent"><?php esc_html_e('Get Started', 'performance-theme'); ?></a>
            </div>
            
            <?php // Enterprise Plan ?>
            <div class="pricing-card">
                <div class="pricing-header">
                    <p class="pricing-name"><?php esc_html_e('Enterprise', 'performance-theme'); ?></p>
                    <p class="pricing-price">$99<span>/Month</span></p>
                </div>
                <ul class="pricing-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Everything in Professional', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Unlimited team members', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Custom integrations', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('Dedicated account manager', 'performance-theme'); ?>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php esc_html_e('SLA guarantee', 'performance-theme'); ?>
                    </li>
                </ul>
                <a href="#" class="btn btn-outline"><?php esc_html_e('Contact Sales', 'performance-theme'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php // Latest Posts Section ?>
<section class="latest-posts-section" aria-labelledby="latest-posts-title">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><?php esc_html_e('Blog', 'performance-theme'); ?></span>
            <h2 id="latest-posts-title" class="section-title">
                <?php esc_html_e('Latest Insights', 'performance-theme'); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e('Stay updated with the latest news and tips.', 'performance-theme'); ?>
            </p>
        </div>
        
        <?php
        $latest_posts = new WP_Query([
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ]);
        
        if ($latest_posts->have_posts()) :
        ?>
            <div class="posts-grid">
                <?php
                while ($latest_posts->have_posts()) :
                    $latest_posts->the_post();
                    get_template_part('template-parts/content/content', 'card');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            
            <div class="section-cta">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline">
                    <?php esc_html_e('View All Posts', 'performance-theme'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php // CTA Section ?>
<section class="cta-section" aria-labelledby="cta-title">
    <div class="container">
        <div class="cta-content">
            <h2 id="cta-title" class="cta-title">
                <?php echo esc_html(get_theme_mod('cta_title', __('Ready to get started?', 'performance-theme'))); ?>
            </h2>
            <p class="cta-description">
                <?php echo esc_html(get_theme_mod('cta_description', __('Join thousands of satisfied customers today and take control of your finances.', 'performance-theme'))); ?>
            </p>
            <div class="hero-actions">
                <?php if (get_theme_mod('cta_button_text', 'Start Now')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('cta_button_url', '#')); ?>" class="btn btn-accent btn-large">
                        <?php echo esc_html(get_theme_mod('cta_button_text', 'Start Now')); ?>
                    </a>
                <?php endif; ?>
                <a href="#" class="btn btn-white btn-large">
                    <?php esc_html_e('Contact Sales', 'performance-theme'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
