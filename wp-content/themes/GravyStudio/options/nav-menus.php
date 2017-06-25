<?php

function register_my_menus() {
    register_nav_menus( array(
        'main-menu' => __( 'Main Navigation'),
        'footer-menu' => __( 'Footer Navigation'),
    ) );
}
add_action( 'init', 'register_my_menus' );

?>