<?php
function register_testimonials()
{

    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonials',
        'add_new' => 'Add New Testimonial',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonials',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' => 'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Testimonials'
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        'taxonomies'          => array( 'category' ),
        'supports' => array( 'title', 'editor','custom-fields','thumbnail','page-attributes','comments'),
        'menu_icon' => get_template_directory_uri() . '/assets/images/testimonial.png',
    );
    register_post_type('testimonials', $args);
}

add_action( 'init', 'register_testimonials' );