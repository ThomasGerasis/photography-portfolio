<?php
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svg'] = 'image/svg';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function add_image_responsive_class($class){
    return $class . ' img-responsive';
}
add_filter('get_image_tag_class','add_image_responsive_class');


//function fix_svg_thumb_display() {
//    echo '
//    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
//      width: 100% !important;
//      height: auto !important;
//    }
//  ';
//}
//add_action('admin_head', 'fix_svg_thumb_display');