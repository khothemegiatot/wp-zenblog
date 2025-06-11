<?php
/**
 * Newsletter and Contact Section Customizer Settings
 */

if (!defined('ABSPATH')) exit;

function zenblog_newsletter_contact_customizer_settings($wp_customize): void {
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
}
add_action('customize_register', 'zenblog_newsletter_contact_customizer_settings'); 