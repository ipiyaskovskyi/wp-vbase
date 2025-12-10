<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php // Preconnect for Google Fonts ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
    <?php esc_html_e('Skip to content', 'performance-theme'); ?>
</a>

<header id="site-header" class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <?php // Site Branding ?>
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <div class="site-logo-icon"></div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php // Primary Navigation ?>
            <nav id="primary-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'performance-theme'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'performance_theme_fallback_menu',
                    'depth'          => 2,
                ]);
                ?>
                
                <a href="#" class="btn btn-primary"><?php esc_html_e('Try Demo', 'performance-theme'); ?></a>
                
                <button 
                    class="menu-toggle" 
                    aria-controls="primary-menu" 
                    aria-expanded="false"
                    aria-label="<?php esc_attr_e('Toggle Menu', 'performance-theme'); ?>"
                >
                    <span class="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </span>
                </button>
            </nav>
        </div>
    </div>
</header>

<main id="main-content" class="site-main" role="main">

<?php
/**
 * Fallback menu when no menu is assigned
 */
function performance_theme_fallback_menu(): void {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Features', 'performance-theme') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Pricing', 'performance-theme') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('For Small Business', 'performance-theme') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Support', 'performance-theme') . '</a></li>';
    echo '</ul>';
}
