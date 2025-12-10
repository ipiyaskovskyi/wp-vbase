<?php
/**
 * Theme Customizer - Full Color Control
 *
 * @package Performance_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register customizer settings
 */
function performance_theme_customize_register(\WP_Customize_Manager $wp_customize): void {
    
    // ========================================
    // TYPOGRAPHY PANEL
    // ========================================
    $wp_customize->add_panel('theme_typography', [
        'title'       => __('🔤 Typography', 'performance-theme'),
        'description' => __('Customize fonts for headings and body text.', 'performance-theme'),
        'priority'    => 19,
    ]);
    
    // Available Google Fonts
    $google_fonts = [
        'Plus Jakarta Sans' => 'Plus Jakarta Sans',
        'Inter'             => 'Inter',
        'Poppins'           => 'Poppins',
        'Montserrat'        => 'Montserrat',
        'Roboto'            => 'Roboto',
        'Open Sans'         => 'Open Sans',
        'Lato'              => 'Lato',
        'Raleway'           => 'Raleway',
        'Nunito'            => 'Nunito',
        'Playfair Display'  => 'Playfair Display',
        'Merriweather'      => 'Merriweather',
        'Source Sans Pro'   => 'Source Sans Pro',
        'DM Sans'           => 'DM Sans',
        'Space Grotesk'     => 'Space Grotesk',
        'Outfit'            => 'Outfit',
        'Manrope'           => 'Manrope',
        'Sora'              => 'Sora',
        'Figtree'           => 'Figtree',
        'Unbounded'         => 'Unbounded',
        'Lexend'            => 'Lexend',
    ];
    
    // --- Headings Typography ---
    $wp_customize->add_section('typography_headings', [
        'title'    => __('Headings Font', 'performance-theme'),
        'panel'    => 'theme_typography',
        'priority' => 10,
    ]);
    
    // Heading Font Family
    $wp_customize->add_setting('font_heading', [
        'default'           => 'Plus Jakarta Sans',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_heading', [
        'label'       => __('Heading Font Family', 'performance-theme'),
        'description' => __('Font for H1-H6 headings', 'performance-theme'),
        'section'     => 'typography_headings',
        'type'        => 'select',
        'choices'     => $google_fonts,
    ]);
    
    // Heading Font Weight
    $wp_customize->add_setting('font_heading_weight', [
        'default'           => '700',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_heading_weight', [
        'label'   => __('Heading Font Weight', 'performance-theme'),
        'section' => 'typography_headings',
        'type'    => 'select',
        'choices' => [
            '400' => __('Regular (400)', 'performance-theme'),
            '500' => __('Medium (500)', 'performance-theme'),
            '600' => __('Semi Bold (600)', 'performance-theme'),
            '700' => __('Bold (700)', 'performance-theme'),
            '800' => __('Extra Bold (800)', 'performance-theme'),
            '900' => __('Black (900)', 'performance-theme'),
        ],
    ]);
    
    // --- Body Typography ---
    $wp_customize->add_section('typography_body', [
        'title'    => __('Body Font', 'performance-theme'),
        'panel'    => 'theme_typography',
        'priority' => 20,
    ]);
    
    // Body Font Family
    $wp_customize->add_setting('font_body', [
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_body', [
        'label'       => __('Body Font Family', 'performance-theme'),
        'description' => __('Font for paragraphs and general text', 'performance-theme'),
        'section'     => 'typography_body',
        'type'        => 'select',
        'choices'     => $google_fonts,
    ]);
    
    // Body Font Weight
    $wp_customize->add_setting('font_body_weight', [
        'default'           => '400',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_body_weight', [
        'label'   => __('Body Font Weight', 'performance-theme'),
        'section' => 'typography_body',
        'type'    => 'select',
        'choices' => [
            '300' => __('Light (300)', 'performance-theme'),
            '400' => __('Regular (400)', 'performance-theme'),
            '500' => __('Medium (500)', 'performance-theme'),
            '600' => __('Semi Bold (600)', 'performance-theme'),
        ],
    ]);
    
    // --- Font Sizes ---
    $wp_customize->add_section('typography_sizes', [
        'title'    => __('Font Sizes', 'performance-theme'),
        'panel'    => 'theme_typography',
        'priority' => 30,
    ]);
    
    // Base Font Size
    $wp_customize->add_setting('font_size_base', [
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_size_base', [
        'label'       => __('Base Font Size (px)', 'performance-theme'),
        'description' => __('Default text size (recommended: 16-18px)', 'performance-theme'),
        'section'     => 'typography_sizes',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ],
    ]);
    
    // H1 Size
    $wp_customize->add_setting('font_size_h1', [
        'default'           => '56',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_size_h1', [
        'label'   => __('H1 Size (px)', 'performance-theme'),
        'section' => 'typography_sizes',
        'type'    => 'number',
        'input_attrs' => [
            'min'  => 24,
            'max'  => 96,
            'step' => 2,
        ],
    ]);
    
    // H2 Size
    $wp_customize->add_setting('font_size_h2', [
        'default'           => '40',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_size_h2', [
        'label'   => __('H2 Size (px)', 'performance-theme'),
        'section' => 'typography_sizes',
        'type'    => 'number',
        'input_attrs' => [
            'min'  => 20,
            'max'  => 72,
            'step' => 2,
        ],
    ]);
    
    // H3 Size
    $wp_customize->add_setting('font_size_h3', [
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('font_size_h3', [
        'label'   => __('H3 Size (px)', 'performance-theme'),
        'section' => 'typography_sizes',
        'type'    => 'number',
        'input_attrs' => [
            'min'  => 16,
            'max'  => 48,
            'step' => 2,
        ],
    ]);
    
    // ========================================
    // COLORS PANEL
    // ========================================
    $wp_customize->add_panel('theme_colors', [
        'title'       => __('🎨 Theme Colors', 'performance-theme'),
        'description' => __('Customize all colors of your theme.', 'performance-theme'),
        'priority'    => 20,
    ]);
    
    // --- Primary Colors Section ---
    $wp_customize->add_section('primary_colors', [
        'title'    => __('Primary Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 10,
    ]);
    
    // Primary Color
    $wp_customize->add_setting('color_primary', [
        'default'           => '#1a3a2f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary', [
        'label'       => __('Primary Color', 'performance-theme'),
        'description' => __('Main brand color (buttons, links, header)', 'performance-theme'),
        'section'     => 'primary_colors',
    ]));
    
    // Primary Dark
    $wp_customize->add_setting('color_primary_dark', [
        'default'           => '#0f2a1f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary_dark', [
        'label'       => __('Primary Dark', 'performance-theme'),
        'description' => __('Darker shade for hover states', 'performance-theme'),
        'section'     => 'primary_colors',
    ]));
    
    // Secondary Color
    $wp_customize->add_setting('color_secondary', [
        'default'           => '#2d5a47',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_secondary', [
        'label'       => __('Secondary Color', 'performance-theme'),
        'description' => __('Supporting brand color', 'performance-theme'),
        'section'     => 'primary_colors',
    ]));
    
    // --- Accent Colors Section ---
    $wp_customize->add_section('accent_colors', [
        'title'    => __('Accent Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 20,
    ]);
    
    // Accent Color
    $wp_customize->add_setting('color_accent', [
        'default'           => '#f5c842',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_accent', [
        'label'       => __('Accent Color', 'performance-theme'),
        'description' => __('Highlight color (CTA buttons, badges)', 'performance-theme'),
        'section'     => 'accent_colors',
    ]));
    
    // Accent Hover
    $wp_customize->add_setting('color_accent_hover', [
        'default'           => '#e5b832',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_accent_hover', [
        'label'       => __('Accent Hover', 'performance-theme'),
        'description' => __('Accent color on hover', 'performance-theme'),
        'section'     => 'accent_colors',
    ]));
    
    // Accent Light
    $wp_customize->add_setting('color_accent_light', [
        'default'           => '#fff8e1',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_accent_light', [
        'label'       => __('Accent Light', 'performance-theme'),
        'description' => __('Light accent for backgrounds', 'performance-theme'),
        'section'     => 'accent_colors',
    ]));
    
    // --- Background Colors Section ---
    $wp_customize->add_section('background_colors', [
        'title'    => __('Background Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 30,
    ]);
    
    // Background
    $wp_customize->add_setting('color_background', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_background', [
        'label'       => __('Background', 'performance-theme'),
        'description' => __('Main page background', 'performance-theme'),
        'section'     => 'background_colors',
    ]));
    
    // Surface
    $wp_customize->add_setting('color_surface', [
        'default'           => '#fdfcf7',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_surface', [
        'label'       => __('Surface', 'performance-theme'),
        'description' => __('Cards and sections background', 'performance-theme'),
        'section'     => 'background_colors',
    ]));
    
    // Surface Alt
    $wp_customize->add_setting('color_surface_alt', [
        'default'           => '#f8f6f0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_surface_alt', [
        'label'       => __('Surface Alt', 'performance-theme'),
        'description' => __('Alternative surface (footer)', 'performance-theme'),
        'section'     => 'background_colors',
    ]));
    
    // Border
    $wp_customize->add_setting('color_border', [
        'default'           => '#e8e5dc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_border', [
        'label'       => __('Border Color', 'performance-theme'),
        'description' => __('Borders and dividers', 'performance-theme'),
        'section'     => 'background_colors',
    ]));
    
    // --- Text Colors Section ---
    $wp_customize->add_section('text_colors', [
        'title'    => __('Text Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 40,
    ]);
    
    // Text
    $wp_customize->add_setting('color_text', [
        'default'           => '#1a3a2f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text', [
        'label'       => __('Text Color', 'performance-theme'),
        'description' => __('Main text color', 'performance-theme'),
        'section'     => 'text_colors',
    ]));
    
    // Text Muted
    $wp_customize->add_setting('color_text_muted', [
        'default'           => '#5a7a6a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_muted', [
        'label'       => __('Text Muted', 'performance-theme'),
        'description' => __('Secondary/muted text', 'performance-theme'),
        'section'     => 'text_colors',
    ]));
    
    // Text Light
    $wp_customize->add_setting('color_text_light', [
        'default'           => '#8a9a8f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text_light', [
        'label'       => __('Text Light', 'performance-theme'),
        'description' => __('Light/subtle text', 'performance-theme'),
        'section'     => 'text_colors',
    ]));
    
    // --- Hero Section Colors ---
    $wp_customize->add_section('hero_colors', [
        'title'    => __('Hero Section Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 50,
    ]);
    
    // Hero Gradient Start
    $wp_customize->add_setting('hero_gradient_start', [
        'default'           => '#f5c842',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_gradient_start', [
        'label'       => __('Hero Gradient Start', 'performance-theme'),
        'description' => __('Top color of hero gradient', 'performance-theme'),
        'section'     => 'hero_colors',
    ]));
    
    // Hero Gradient Middle
    $wp_customize->add_setting('hero_gradient_middle', [
        'default'           => '#e8d678',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_gradient_middle', [
        'label'       => __('Hero Gradient Middle', 'performance-theme'),
        'description' => __('Middle color of hero gradient', 'performance-theme'),
        'section'     => 'hero_colors',
    ]));
    
    // Hero Gradient End
    $wp_customize->add_setting('hero_gradient_end', [
        'default'           => '#fdfcf7',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_gradient_end', [
        'label'       => __('Hero Gradient End', 'performance-theme'),
        'description' => __('Bottom color of hero gradient', 'performance-theme'),
        'section'     => 'hero_colors',
    ]));
    
    // --- CTA Section Colors ---
    $wp_customize->add_section('cta_colors', [
        'title'    => __('CTA Section Colors', 'performance-theme'),
        'panel'    => 'theme_colors',
        'priority' => 60,
    ]);
    
    // CTA Background
    $wp_customize->add_setting('cta_background', [
        'default'           => '#1a3a2f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cta_background', [
        'label'       => __('CTA Background', 'performance-theme'),
        'description' => __('CTA section background', 'performance-theme'),
        'section'     => 'cta_colors',
    ]));
    
    // CTA Text
    $wp_customize->add_setting('cta_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cta_text_color', [
        'label'       => __('CTA Text Color', 'performance-theme'),
        'description' => __('Text color in CTA section', 'performance-theme'),
        'section'     => 'cta_colors',
    ]));
    
    // ========================================
    // CONTENT PANEL
    // ========================================
    $wp_customize->add_panel('theme_content', [
        'title'       => __('📝 Page Content', 'performance-theme'),
        'description' => __('Customize page content and sections.', 'performance-theme'),
        'priority'    => 30,
    ]);
    
    // --- Hero Section ---
    $wp_customize->add_section('hero_section', [
        'title'    => __('Hero Section', 'performance-theme'),
        'panel'    => 'theme_content',
        'priority' => 10,
    ]);
    
    $wp_customize->add_setting('hero_badge', [
        'default'           => __('Effortless Solutions', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('hero_badge', [
        'label'   => __('Hero Badge Text', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('hero_title', [
        'default'           => __('Smart finance tools for individuals and growing small businesses.', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('hero_title', [
        'label'   => __('Hero Title', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ]);
    
    $wp_customize->add_setting('hero_subtitle', [
        'default'           => __('Effortless financial management designed to empower individuals and small businesses with clarity, speed, and reliable growth tools.', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('hero_subtitle', [
        'label'   => __('Hero Subtitle', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ]);
    
    $wp_customize->add_setting('hero_cta_text', [
        'default'           => __('Try Demo', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_cta_text', [
        'label'   => __('Primary Button Text', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('hero_cta_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_cta_url', [
        'label'   => __('Primary Button URL', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);
    
    $wp_customize->add_setting('hero_secondary_text', [
        'default'           => __('Watch Tutorial', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_secondary_text', [
        'label'   => __('Secondary Button Text', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('hero_secondary_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_secondary_url', [
        'label'   => __('Secondary Button URL', 'performance-theme'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);
    
    // --- Features Section ---
    $wp_customize->add_section('features_section', [
        'title'    => __('Features Section', 'performance-theme'),
        'panel'    => 'theme_content',
        'priority' => 20,
    ]);
    
    $wp_customize->add_setting('features_title', [
        'default'           => __('Everything you need to manage finances', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('features_title', [
        'label'   => __('Section Title', 'performance-theme'),
        'section' => 'features_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('features_description', [
        'default'           => __('Powerful tools designed to help you grow your business.', 'performance-theme'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('features_description', [
        'label'   => __('Section Description', 'performance-theme'),
        'section' => 'features_section',
        'type'    => 'textarea',
    ]);
    
    // Feature items 1-3
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("feature_{$i}_title", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("feature_{$i}_title", [
            'label'   => sprintf(__('Feature %d Title', 'performance-theme'), $i),
            'section' => 'features_section',
            'type'    => 'text',
        ]);
        
        $wp_customize->add_setting("feature_{$i}_description", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("feature_{$i}_description", [
            'label'   => sprintf(__('Feature %d Description', 'performance-theme'), $i),
            'section' => 'features_section',
            'type'    => 'textarea',
        ]);
    }
    
    // --- CTA Section ---
    $wp_customize->add_section('cta_section', [
        'title'    => __('CTA Section', 'performance-theme'),
        'panel'    => 'theme_content',
        'priority' => 30,
    ]);
    
    $wp_customize->add_setting('cta_title', [
        'default'           => __('Ready to get started?', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('cta_title', [
        'label'   => __('CTA Title', 'performance-theme'),
        'section' => 'cta_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('cta_description', [
        'default'           => __('Join thousands of satisfied customers today and take control of your finances.', 'performance-theme'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('cta_description', [
        'label'   => __('CTA Description', 'performance-theme'),
        'section' => 'cta_section',
        'type'    => 'textarea',
    ]);
    
    $wp_customize->add_setting('cta_button_text', [
        'default'           => __('Start Now', 'performance-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('cta_button_text', [
        'label'   => __('Button Text', 'performance-theme'),
        'section' => 'cta_section',
        'type'    => 'text',
    ]);
    
    $wp_customize->add_setting('cta_button_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('cta_button_url', [
        'label'   => __('Button URL', 'performance-theme'),
        'section' => 'cta_section',
        'type'    => 'url',
    ]);
    
    // ========================================
    // SOCIAL LINKS
    // ========================================
    $wp_customize->add_section('social_links', [
        'title'    => __('🔗 Social Links', 'performance-theme'),
        'priority' => 40,
    ]);
    
    $social_networks = [
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter/X',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'youtube'   => 'YouTube',
    ];
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("{$network}_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("{$network}_url", [
            'label'   => $label,
            'section' => 'social_links',
            'type'    => 'url',
        ]);
    }
}
add_action('customize_register', 'performance_theme_customize_register');

/**
 * Output dynamic CSS based on customizer settings
 */
function performance_theme_customizer_css(): void {
    // Typography settings
    $font_heading        = get_theme_mod('font_heading', 'Plus Jakarta Sans');
    $font_heading_weight = get_theme_mod('font_heading_weight', '700');
    $font_body           = get_theme_mod('font_body', 'Inter');
    $font_body_weight    = get_theme_mod('font_body_weight', '400');
    $font_size_base      = get_theme_mod('font_size_base', '16');
    $font_size_h1        = get_theme_mod('font_size_h1', '56');
    $font_size_h2        = get_theme_mod('font_size_h2', '40');
    $font_size_h3        = get_theme_mod('font_size_h3', '24');
    
    // Color settings
    $colors = [
        'color_primary'        => get_theme_mod('color_primary', '#1a3a2f'),
        'color_primary_dark'   => get_theme_mod('color_primary_dark', '#0f2a1f'),
        'color_secondary'      => get_theme_mod('color_secondary', '#2d5a47'),
        'color_accent'         => get_theme_mod('color_accent', '#f5c842'),
        'color_accent_hover'   => get_theme_mod('color_accent_hover', '#e5b832'),
        'color_accent_light'   => get_theme_mod('color_accent_light', '#fff8e1'),
        'color_background'     => get_theme_mod('color_background', '#ffffff'),
        'color_surface'        => get_theme_mod('color_surface', '#fdfcf7'),
        'color_surface_alt'    => get_theme_mod('color_surface_alt', '#f8f6f0'),
        'color_border'         => get_theme_mod('color_border', '#e8e5dc'),
        'color_text'           => get_theme_mod('color_text', '#1a3a2f'),
        'color_text_muted'     => get_theme_mod('color_text_muted', '#5a7a6a'),
        'color_text_light'     => get_theme_mod('color_text_light', '#8a9a8f'),
        'hero_gradient_start'  => get_theme_mod('hero_gradient_start', '#f5c842'),
        'hero_gradient_middle' => get_theme_mod('hero_gradient_middle', '#e8d678'),
        'hero_gradient_end'    => get_theme_mod('hero_gradient_end', '#fdfcf7'),
        'cta_background'       => get_theme_mod('cta_background', '#1a3a2f'),
        'cta_text_color'       => get_theme_mod('cta_text_color', '#ffffff'),
    ];
    ?>
    <style id="theme-customizer-css">
        :root {
            /* Typography */
            --font-family: '<?php echo esc_attr($font_body); ?>', system-ui, -apple-system, sans-serif;
            --font-family-display: '<?php echo esc_attr($font_heading); ?>', var(--font-family);
            --font-weight-body: <?php echo esc_attr($font_body_weight); ?>;
            --font-weight-heading: <?php echo esc_attr($font_heading_weight); ?>;
            --font-size-base: <?php echo esc_attr($font_size_base); ?>px;
            --font-size-5xl: <?php echo esc_attr($font_size_h1); ?>px;
            --font-size-4xl: <?php echo esc_attr($font_size_h2); ?>px;
            --font-size-2xl: <?php echo esc_attr($font_size_h3); ?>px;
            
            /* Colors */
            --color-primary: <?php echo esc_attr($colors['color_primary']); ?>;
            --color-primary-dark: <?php echo esc_attr($colors['color_primary_dark']); ?>;
            --color-secondary: <?php echo esc_attr($colors['color_secondary']); ?>;
            --color-accent: <?php echo esc_attr($colors['color_accent']); ?>;
            --color-accent-hover: <?php echo esc_attr($colors['color_accent_hover']); ?>;
            --color-accent-light: <?php echo esc_attr($colors['color_accent_light']); ?>;
            --color-background: <?php echo esc_attr($colors['color_background']); ?>;
            --color-surface: <?php echo esc_attr($colors['color_surface']); ?>;
            --color-surface-alt: <?php echo esc_attr($colors['color_surface_alt']); ?>;
            --color-border: <?php echo esc_attr($colors['color_border']); ?>;
            --color-text: <?php echo esc_attr($colors['color_text']); ?>;
            --color-text-muted: <?php echo esc_attr($colors['color_text_muted']); ?>;
            --color-text-light: <?php echo esc_attr($colors['color_text_light']); ?>;
        }
        
        body {
            font-weight: var(--font-weight-body);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: var(--font-weight-heading);
        }
        
        .hero-section {
            background: linear-gradient(180deg, 
                <?php echo esc_attr($colors['hero_gradient_start']); ?> 0%, 
                <?php echo esc_attr($colors['hero_gradient_middle']); ?> 50%, 
                <?php echo esc_attr($colors['hero_gradient_end']); ?> 100%
            );
        }
        
        .cta-section {
            background: <?php echo esc_attr($colors['cta_background']); ?>;
            color: <?php echo esc_attr($colors['cta_text_color']); ?>;
        }
        
        .cta-section .cta-title {
            color: <?php echo esc_attr($colors['cta_text_color']); ?>;
        }
        
        .pricing-card.featured {
            background: <?php echo esc_attr($colors['color_primary']); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'performance_theme_customizer_css', 100);

/**
 * Enqueue Google Fonts based on customizer settings
 */
function performance_theme_google_fonts(): void {
    $font_heading = get_theme_mod('font_heading', 'Plus Jakarta Sans');
    $font_body    = get_theme_mod('font_body', 'Inter');
    
    // Build fonts array with weights
    $fonts = [];
    
    // Heading font weights
    $heading_weights = '500;600;700;800';
    $fonts[] = str_replace(' ', '+', $font_heading) . ':wght@' . $heading_weights;
    
    // Body font weights (only add if different from heading)
    if ($font_body !== $font_heading) {
        $body_weights = '400;500;600;700';
        $fonts[] = str_replace(' ', '+', $font_body) . ':wght@' . $body_weights;
    }
    
    // Build Google Fonts URL
    $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $fonts) . '&display=swap';
    
    // Enqueue Google Fonts
    wp_enqueue_style(
        'performance-theme-google-fonts',
        $fonts_url,
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'performance_theme_google_fonts', 5);

/**
 * Enqueue customizer preview script for live preview
 */
function performance_theme_customizer_preview(): void {
    wp_enqueue_script(
        'performance-theme-customizer',
        THEME_URI . '/assets/js/customizer.js',
        ['customize-preview', 'jquery'],
        THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'performance_theme_customizer_preview');
