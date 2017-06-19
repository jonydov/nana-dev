<?php

    register_taxonomy('departments', 'careers', array(
        'label' => __('Departments'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => false,
    ));

    register_taxonomy('positions-locations', 'careers', array(
        'label' => __('Positions Locations'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => false,
    ));

?>
