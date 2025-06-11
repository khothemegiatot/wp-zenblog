<?php
/**
 * Theme setup functions
 */

if (!defined('ABSPATH')) exit;

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