<?php
/**
 * Featured Post Customizer Settings
 */

if (!defined('ABSPATH')) exit;

function zenblog_featured_post_customizer_settings($wp_customize): void {
    // Featured Post Settings
    $wp_customize->add_section('featured_post_settings', array(
        'title'    => __('Featured Post Settings', 'zenblog'),
        'priority' => 105,
    ));

    // Enable/Disable Featured Post Section
    $wp_customize->add_setting('featured_section_enable', array(
        'default'           => true,
        'sanitize_callback' => 'zenblog_sanitize_checkbox',
    ));

    $wp_customize->add_control('featured_section_enable', array(
        'label'    => __('Enable Featured Post Section', 'zenblog'),
        'section'  => 'featured_post_settings',
        'type'     => 'checkbox',
    ));

    // Featured Post Selection Method
    $wp_customize->add_setting('featured_post_method', array(
        'default'           => 'latest',
        'sanitize_callback' => 'zenblog_sanitize_select',
    ));

    $wp_customize->add_control('featured_post_method', array(
        'label'    => __('Featured Post Selection', 'zenblog'),
        'section'  => 'featured_post_settings',
        'type'     => 'select',
        'choices'  => array(
            'latest'   => __('Latest Post', 'zenblog'),
            'sticky'   => __('Sticky Post', 'zenblog'),
            'specific' => __('Specific Post', 'zenblog'),
        ),
    ));

    // Specific Post Selection
    $wp_customize->add_setting('featured_post_id', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'featured_post_id', array(
        'label'       => __('Search and Select Post', 'zenblog'),
        'description' => __('Start typing to search for posts...', 'zenblog'),
        'section'     => 'featured_post_settings',
        'type'        => 'text',
        'input_attrs' => array(
            'class'       => 'zenblog-post-search',
            'placeholder' => __('Search posts...', 'zenblog'),
            'data-selected' => get_the_title(get_theme_mod('featured_post_id')),
        ),
    )));

    // Section Title
    $wp_customize->add_setting('featured_section_title', array(
        'default'           => __('Featured Post', 'zenblog'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('featured_section_title', array(
        'label'    => __('Section Title', 'zenblog'),
        'section'  => 'featured_post_settings',
        'type'     => 'text',
    ));
}

add_action('customize_register', 'zenblog_featured_post_customizer_settings'); 