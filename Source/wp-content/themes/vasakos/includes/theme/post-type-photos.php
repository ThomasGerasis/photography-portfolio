<?php
function register_photos()
{

    $labels = array(
        'name' => 'Photos',
        'singular_name' => 'Photo',
        'add_new' => 'Add New Photo',
        'add_new_item' => 'Add New Photo',
        'edit_item' => 'Edit Photos',
        'new_item' => 'New Photos',
        'view_item' => 'View Photos',
        'search_items' => 'Search Photos',
        'not_found' => 'No Photos found',
        'not_found_in_trash' => 'No Photos found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Photos'
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'has_front' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        // 'taxonomies' => array('category'),
        'supports' => array('custom-fields', 'thumbnail'),
        'menu_icon' => get_template_directory_uri() . '/assets/images/camera.png',
    );
    register_post_type('photos', $args);
}

add_action('init', 'register_photos');

function register_photoshoot_taxonomy()
{

    register_taxonomy('photoshoots', 'photos', array(
        'labels' => array(
            'name' => 'Photoshoots',
            'singular_name' => 'Photoshoot',
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array(
            'slug' => 'photoshoots',
            'with_front' => false
        ),
        'show_in_rest' => true,
        'show_ui' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'register_photoshoot_taxonomy');
