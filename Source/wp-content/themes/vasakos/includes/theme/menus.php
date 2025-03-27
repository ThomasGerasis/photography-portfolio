<?php
function vasakos_theme_menus() {
    register_nav_menus(
        array(
            'main-menu'  => __( 'Main Menu', 'vasakos' ),
            'mobile-menu'  => __( 'Mobile Header', 'vasakos' ),
            'left-menu' => __( 'Left Menu', 'vasakos' ),
            'right-menu' => __( 'Right Menu', 'vasakos' ),
            'footer-menu'  => __( 'Footer Right', 'vasakos' ),
            'footer-menu-2'  => __( 'Footer left', 'vasakos' ),
            'main-menu-burger' => __( 'Mobile Menu' , 'vasakos' ),
        )
    );
}

add_action( 'init', 'vasakos_theme_menus' );