<?php


$files = glob( get_template_directory() . '/includes/theme/*.php' );

foreach ( $files as $file ) {
    include $file;
}

$files = glob( get_template_directory() . '/includes/functions/schemas/*.php' );

foreach ( $files as $file ) {
    include $file;
}


$files = glob( get_template_directory() . '/includes/settings-page/*.php' );

foreach ( $files as $file ) {
    include $file;
}

$files = glob( get_template_directory() . '/includes/shortcodes/*.php' );

foreach ( $files as $file ) {
    include $file;
}


$files = glob( get_template_directory() . '/includes/functions/*.php' );

foreach ( $files as $file ) {
    include $file;
}


require_once( get_template_directory() . '/includes/ajax-helper.php');
require_once( get_template_directory() . '/includes/plugins/wpalchemy/setup.php');
require_once( get_template_directory() . '/includes/plugins/wpalchemy/set_metaboxes.php');
require_once( get_template_directory() . '/includes/settings-page/SliderSettings.php');
require_once( get_template_directory() . '/includes/settings-page/SliderSettingsCarousel.php');

use SettingsPages\SliderSettings;
use SettingsPages\SliderSettingsCarousel;
use SettingsPages\BasicSettings;

new SliderSettings('photos');
new SliderSettingsCarousel('photos');
new BasicSettings('photos');

//function wpb_change_search_url() {
//    if ( is_search() && ! empty( $_GET['s'] ) ) {
//        wp_redirect( home_url( "/akinita/" ) . urlencode( get_query_var( 's' ) ) );
//        exit();
//    }
//}
//add_action( 'template_redirect', 'wpb_change_search_url' );