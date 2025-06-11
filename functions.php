<?php
// Theme functions and setup
function zenblog_theme_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Đăng ký các vị trí menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'zenblog'),
        'footer'  => __('Footer Menu', 'zenblog'),
        'primary-menu' => __('Primary Menu', 'zenblog'),
        'mobile-menu' => __('Mobile Menu', 'zenblog')
    ));
}
add_action('after_setup_theme', 'zenblog_theme_setup');

function zenblog_enqueue_scripts(): void {
    wp_enqueue_style('tailwind', 'https://cdn.tailwindcss.com');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('zenblog-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'zenblog_enqueue_scripts');

// Thêm các class Tailwind vào menu items
function zenblog_add_nav_classes($classes, $item) {
    $classes[] = 'text-gray-800 hover:text-blue-600 font-medium';
    return $classes;
}
add_filter('nav_menu_css_class', 'zenblog_add_nav_classes', 10, 2);

function zenblog_add_nav_anchor_class($atts) {
    $atts['class'] = 'nav-link text-gray-800 hover:text-blue-600 font-medium';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'zenblog_add_nav_anchor_class', 10);

// Đăng ký các widget areas cho footer
function zenblog_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Column 1', 'zenblog'),
        'id'            => 'footer-1',
        'description'   => __('Widget area cho cột đầu tiên của footer', 'zenblog'),
        'before_widget' => '<div class="mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold mb-4">',
        'after_title'   => '</h4>'
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 2', 'zenblog'),
        'id'            => 'footer-2',
        'description'   => __('Widget area cho cột thứ hai của footer', 'zenblog'),
        'before_widget' => '<div class="mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold mb-4">',
        'after_title'   => '</h4>'
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 3', 'zenblog'),
        'id'            => 'footer-3',
        'description'   => __('Widget area cho cột thứ ba của footer', 'zenblog'),
        'before_widget' => '<div class="mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="text-lg font-semibold mb-4">',
        'after_title'   => '</h4>'
    ));
}
add_action('widgets_init', 'zenblog_widgets_init');

// Thêm tùy chỉnh Customizer
function zenblog_customize_register($wp_customize) {
    // About Section Settings
    $wp_customize->add_section('about_settings', array(
        'title'    => __('About Section Settings', 'zenblog'),
        'priority' => 110,
    ));

    // Enable/Disable About Section
    $wp_customize->add_setting('about_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'zenblog_sanitize_checkbox',
    ));

    $wp_customize->add_control('about_section_enable', array(
        'label'    => __('Enable About Section', 'zenblog'),
        'section'  => 'about_settings',
        'type'     => 'checkbox',
    ));

    // About Image
    $wp_customize->add_setting('about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label'    => __('About Image', 'zenblog'),
        'section'  => 'about_settings',
    )));

    // About Name
    $wp_customize->add_setting('about_name', array(
        'default'           => 'Alex Morgan',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_name', array(
        'label'    => __('Your Name', 'zenblog'),
        'section'  => 'about_settings',
        'type'     => 'text',
    ));

    // About Description
    $wp_customize->add_setting('about_description', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('about_description', array(
        'label'    => __('About Description', 'zenblog'),
        'section'  => 'about_settings',
        'type'     => 'textarea',
    ));

    // Social Links
    $social_platforms = array('twitter', 'instagram', 'linkedin');
    
    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting('about_social_' . $platform, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('about_social_' . $platform, array(
            'label'    => sprintf(__('%s URL', 'zenblog'), ucfirst($platform)),
            'section'  => 'about_settings',
            'type'     => 'url',
        ));
    }

    // Newsletter Section Settings
    $wp_customize->add_section('newsletter_settings', array(
        'title'    => __('Newsletter Section Settings', 'zenblog'),
        'priority' => 115,
    ));

    // Enable/Disable Newsletter Section
    $wp_customize->add_setting('newsletter_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'zenblog_sanitize_checkbox',
    ));

    $wp_customize->add_control('newsletter_section_enable', array(
        'label'    => __('Enable Newsletter Section', 'zenblog'),
        'section'  => 'newsletter_settings',
        'type'     => 'checkbox',
    ));

    // Newsletter Title
    $wp_customize->add_setting('newsletter_title', array(
        'default'           => __('Subscribe to My Newsletter', 'zenblog'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('newsletter_title', array(
        'label'    => __('Newsletter Title', 'zenblog'),
        'section'  => 'newsletter_settings',
        'type'     => 'text',
    ));

    // Newsletter Description
    $wp_customize->add_setting('newsletter_description', array(
        'default'           => __('Get notified when I publish new articles. No spam, just quality content.', 'zenblog'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('newsletter_description', array(
        'label'    => __('Newsletter Description', 'zenblog'),
        'section'  => 'newsletter_settings',
        'type'     => 'textarea',
    ));

    // Contact Section Settings
    $wp_customize->add_section('contact_settings', array(
        'title'    => __('Contact Section Settings', 'zenblog'),
        'priority' => 116,
    ));

    // Enable/Disable Contact Section
    $wp_customize->add_setting('contact_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'zenblog_sanitize_checkbox',
    ));

    $wp_customize->add_control('contact_section_enable', array(
        'label'    => __('Enable Contact Section', 'zenblog'),
        'section'  => 'contact_settings',
        'type'     => 'checkbox',
    ));

    // Contact Title
    $wp_customize->add_setting('contact_title', array(
        'default'           => __('Get In Touch', 'zenblog'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_title', array(
        'label'    => __('Contact Title', 'zenblog'),
        'section'  => 'contact_settings',
        'type'     => 'text',
    ));

    // Contact Description
    $wp_customize->add_setting('contact_description', array(
        'default'           => __('Have a question or just want to say hi? Drop me a message!', 'zenblog'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_description', array(
        'label'    => __('Contact Description', 'zenblog'),
        'section'  => 'contact_settings',
        'type'     => 'textarea',
    ));

    // Contact Form Shortcode
    $wp_customize->add_setting('contact_form_shortcode', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_form_shortcode', array(
        'label'       => __('Contact Form Shortcode', 'zenblog'),
        'description' => __('Enter the shortcode of your contact form plugin (e.g., Contact Form 7)', 'zenblog'),
        'section'     => 'contact_settings',
        'type'        => 'text',
    ));

    // Footer Settings (existing code)
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Footer Settings', 'zenblog'),
        'priority' => 120,
    ));

    $wp_customize->add_setting('footer_copyright_text', array(
        'default'           => 'All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('footer_copyright_text', array(
        'label'    => __('Copyright Text', 'zenblog'),
        'section'  => 'footer_settings',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'zenblog_customize_register');

// Sanitize checkbox
function zenblog_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}
