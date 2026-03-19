<?php
function custom_columns( $columns ) {
    $columns = array(
        "cb"             => "<input type='checkbox' />",
        'featured_image' => 'Image',
        'photoshoots'    => 'Photoshoots',
        'date'           => 'Date'
    );
    return $columns;
}
add_filter( 'manage_photos_posts_columns', 'custom_columns' );

function custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_image':
            echo get_the_post_thumbnail( $post_id, 'thumbnail' );
            break;
        case 'photoshoots':
            $terms = get_the_terms( $post_id, 'photoshoots' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                $links = array();
                foreach ( $terms as $term ) {
                    $links[] = '<a href="' . esc_url( add_query_arg( array( 'post_type' => 'photos', 'photoshoots' => $term->slug ), 'edit.php' ) ) . '">' . esc_html( $term->name ) . '</a>';
                }
                echo implode( ', ', $links );
            } else {
                echo '&mdash;';
            }
            break;
    }
}
add_action( 'manage_photos_posts_custom_column', 'custom_columns_data', 10, 2 );
