<?php
register_post_type('artists', array(
    'label' => __('אמנים'),
    'singular_label' => __('אמן'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'query_var' => false,
	'menu_icon'   => 'dashicons-heart',
    'rewrite' => array('slug' => 'artists'),
    'supports' => array(
	    'title',
	    'tags',
	    'editor',
	    'excerpt',
	    'thumbnail',
    )
));

register_post_type('albums', array(
	'label' => __('אלבומים'),
	'singular_label' => __('אלבום'),
	'public' => true,
	'show_ui' => true,
	'menu_icon'   => 'dashicons-format-audio',
	'capability_type' => 'post',
	'hierarchical' => false,
	'query_var' => false,
	'rewrite' => array('slug' => 'albums'),
	'supports' => array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
	)
));

register_post_type('news', array(
	'label' => __('חדשות'),
	'singular_label' => __('אייטם'),
	'public' => true,
	'show_ui' => true,
	'menu_icon'   => 'dashicons-calendar-alt',
	'capability_type' => 'post',
    'hierarchical' => false,
    'query_var' => false,
	'has_archive'           => true,
	'taxonomies'  => array( 'post_tag' ),
    'rewrite' => array('slug' => 'news', "with_front" => true),
    'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
    )
));

register_post_type('video-clips', array(
	'label' => __('קליפים'),
	'singular_label' => __('קליפ'),
	'public' => true,
	'show_ui' => true,
	'menu_icon'   => 'dashicons-format-video',
	'capability_type' => 'post',
    'hierarchical' => false,
    'query_var' => false,
    'rewrite' => array('slug' => 'videos'),
    'supports' => array(
        'title',
        'editor',
        'thumbnail',
    )
));

register_post_type('shows', array(
	'label' => __('הופעות'),
	'singular_label' => __('הופעה'),
	'public' => true,
	'show_ui' => true,
	'menu_icon'   => 'dashicons-groups',
	'capability_type' => 'post',
    'hierarchical' => false,
    'query_var' => false,
    'rewrite' => array('slug' => 'shows'),
    'supports' => array(
        'title',
        'editor',
        'thumbnail',
    )
));

register_post_type('productions', array(
    'label' => __('הפקות'),
    'singular_label' => __('הפקה'),
    'public' => true,
    'show_ui' => true,
    'menu_icon'   => 'dashicons-calendar-alt',
    'capability_type' => 'post',
    'hierarchical' => false,
    'query_var' => false,
    'has_archive'           => true,
    'taxonomies'  => array( 'post_tag' ),
    'rewrite' => array('slug' => 'productions', "with_front" => true),
    'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
    )
));

?>