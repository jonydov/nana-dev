<?php

    register_taxonomy('year', 'albums', array(
        'label' => __('Year'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => false,
    ));

    register_taxonomy('album-type', 'albums', array(
        'label' => __('סוג'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => false,
    ));

    register_taxonomy('location', 'shows', array(
        'label' => __('מקום'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => false,
    ));

?>
