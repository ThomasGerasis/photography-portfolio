<?php
function custom_columns( $columns ) {
    $columns = array(
        "cb" => "<input type ='checkbox' />",
        'featured_image' => 'Image',
        'category' => 'Category',
        'date' => 'Date'
    );
    return $columns;
}
add_filter('manage_photos_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_image':
            echo get_the_post_thumbnail($post_id,'thumbnail');
            break;
        case 'category':
            $category_detail=get_the_category($post_id);//$post->ID
            foreach($category_detail as $cd){
                echo '<a href="edit.php?post_type=photos&category_name='.$cd->cat_name.'">'.$cd->cat_name.'</a>';
            }
            break;
    }
}
add_action( 'manage_photos_posts_custom_column' , 'custom_columns_data', 10, 2 );