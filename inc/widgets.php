<?php
/**
 * Widget Registration
 */

if (!defined('ABSPATH')) exit;

function zenblog_widgets_init(): void {
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