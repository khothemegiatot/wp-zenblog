<?php
/**
 * Theme Functions
 * 
 * @package ZenBlog
 */

if (!defined('ABSPATH')) exit;

// Load các file chức năng
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/customizer.php';

// Include template functions
require get_template_directory() . '/inc/template-functions.php';

// Thêm các class Tailwind vào menu items
function zenblog_add_nav_classes($classes, $item): mixed {
    $classes[] = 'text-gray-800 hover:text-blue-600 font-medium';
    return $classes;
}

add_filter('nav_menu_css_class', 'zenblog_add_nav_classes', 10, 2);

function zenblog_add_nav_anchor_class($atts): mixed {
    $atts['class'] = 'nav-link text-gray-800 hover:text-blue-600 font-medium';
    return $atts;
}

add_filter('nav_menu_link_attributes', 'zenblog_add_nav_anchor_class', 10);