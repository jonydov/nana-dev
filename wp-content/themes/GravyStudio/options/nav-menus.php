<?php

function register_my_menus() {
    register_nav_menus( array(
        'main-menu' => __( 'Main Navigation'),
        'locations-menu' => __( 'Locations Menu'),
        'contact-menu' => __( 'Contact Menu'),
        'footer-menu' => __( 'Footer Navigation'),
        'footer-menu-bottom' => __( 'Footer Bottom Navigation'),
    ) );
}
add_action( 'init', 'register_my_menus' );

?>