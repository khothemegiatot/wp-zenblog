<?php
/**
 * About Section Customizer Settings
 */

if (!defined('ABSPATH')) exit;

function zenblog_customize_about_section($wp_customize): void {
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
}

add_action('customize_register', 'zenblog_customize_about_section'); 