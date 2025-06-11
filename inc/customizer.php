<?php
/**
 * Customizer Setup and Custom Controls
 */

if (!defined('ABSPATH')) exit;

// Get posts for customizer dropdown
function zenblog_get_posts_for_customizer(): array {
    $posts = get_posts(array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));

    $choices = array('' => __('-- Select Post --', 'zenblog'));
    foreach ($posts as $post) {
        $choices[$post->ID] = esc_html($post->post_title);
    }

    return $choices;
}

// Enqueue scripts cho customizer
function zenblog_customize_controls_enqueue_scripts(): void {
    wp_enqueue_script(
        'zenblog-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array('jquery', 'customize-controls'),
        '1.0',
        true
    );

    wp_localize_script('zenblog-customizer-controls', 'zenblogCustomizer', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('zenblog_search_posts_nonce'),
    ));
}

add_action('customize_controls_enqueue_scripts', 'zenblog_customize_controls_enqueue_scripts');

// AJAX handler cho tìm kiếm bài viết
function zenblog_ajax_search_posts(): void {
    check_ajax_referer('zenblog_search_posts_nonce', 'nonce');

    $search_term = sanitize_text_field($_POST['search']);
    
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 10,
        's'              => $search_term,
    );

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'url'   => get_permalink(),
            );
        }
    }

    wp_reset_postdata();
    wp_send_json_success($results);
}
add_action('wp_ajax_zenblog_search_posts', 'zenblog_ajax_search_posts');

// Sanitize functions
function zenblog_sanitize_checkbox($checked): bool {
    return ((isset($checked) && true == $checked) ? true : false);
}

function zenblog_sanitize_select($input, $setting): mixed {
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

// Load các file customizer
require get_template_directory() . '/inc/customizer/about.php';
require get_template_directory() . '/inc/customizer/featured-post.php';
require get_template_directory() . '/inc/customizer/newsletter-contact.php';
require get_template_directory() . '/inc/customizer/footer.php'; 