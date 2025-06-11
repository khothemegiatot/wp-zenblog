<?php
/**
 * Footer Customizer Settings
 */

if (!defined('ABSPATH')) exit;

function zenblog_footer_customizer_settings($wp_customize): void {
    // Footer Settings
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Footer Settings', 'zenblog'),
        'priority' => 120,
    ));

    // Copyright Text
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

add_action('customize_register', 'zenblog_footer_customizer_settings'); 