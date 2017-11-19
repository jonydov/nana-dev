<?php

    define('TMPL_URL', dirname(__FILE__) . DIRECTORY_SEPARATOR);

    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Settings',
            'menu_title'	=> 'הגדרות תבנית',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }

    register_sidebar( array(
        'id'          => 'news-archives',
        'name'        => __( 'News Archives' ),
        'description' => __( 'This sidebar is located above the age logo.'),
    ) );

    register_sidebar( array(
        'id'          => 'productions-archives',
        'name'        => __( 'Productions Archives' ),
        'description' => __( 'This sidebar is located above the age logo.'),
    ) );

    function gs_enqueue_scripts() {
        wp_enqueue_script('jQuery', get_template_directory_uri()."/assets/js/jquery-2.2.4.min.js");
        wp_enqueue_script('slick', get_template_directory_uri()."/assets/js/slick.min.js");
        wp_enqueue_script('skrollr', get_template_directory_uri()."/assets/js/skrollr.min.js");
        wp_enqueue_script('bootstrap', get_template_directory_uri()."/assets/js/bootstrap.min.js");
	    wp_enqueue_script('magnific-js' , get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
	    wp_enqueue_script('isotope-js' , get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
	    wp_enqueue_script('functions-js' , get_stylesheet_directory_uri() . '/assets/js/functions.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
    }
    add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );

    if( !is_admin() ){
        wp_enqueue_style('magnific-css', get_template_directory_uri()."/assets/css/magnific-popup.min.css");
        wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css');
        wp_enqueue_style('animate-css', get_template_directory_uri()."/assets/css/slick.min.css");
        wp_enqueue_style('bootstrap-css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
        wp_enqueue_style('material-css', get_template_directory_uri()."/assets/css/material-design-iconic-font.min.css");
        wp_enqueue_style('font-awesome-css', get_template_directory_uri()."/assets/css/font-awesome.min.css");
        wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), 1.12345, false, 'all' );
    }

    // Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

	require_once('wp_bootstrap_navwalker.php');

	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}

	add_post_type_support( 'page', 'excerpt' );

    # Attach Custom Post Types and Custom Taxonomies
    add_action('init', 'attach_post_types_and_taxonomies', 0);
    function attach_post_types_and_taxonomies()
    {
        # Attach Custom Post Types
        include_once(TMPL_URL . 'options/post-types.php');

        # Attach Nav Menus
        include_once(TMPL_URL . 'options/nav-menus.php');

        # Attach Custom Taxonomies
        include_once(TMPL_URL . 'options/taxonomies.php');
        include_once(TMPL_URL . 'options/post-types.php');

    }

// image sizes
//add_image_size( 'location-home-thumb', 194, 171, true );

// add friendly page class names
function custom_body_classes($classes) {
    $classes[] = preg_replace( '/\.php/', '', basename( get_page_template() ) );
    return $classes;
}
add_filter('body_class', 'custom_body_classes');

// display image tag for custom image field
function acf_img( $name, $is_sub = false, $classes = "", $size = "" ) {
    if ($is_sub) {
        $img = get_sub_field($name);
    }
    else {
        $img = get_field($name);
    }

    if ($img) {
        $url = $size ? $img['sizes'][$size] : $img['url'];
        $width = $size ? $img['sizes'][$size .'-width'] : $img['width'];
        $height = $size ? $img['sizes'][$size .'-height'] : $img['height'];
        $alt = htmlspecialchars( $img['alt'] );

        echo "<img class='$classes' src='$url' width='$width' height='$height' alt='$alt'>";
    }
}

// allow SVG uploads
function add_svg_to_upload_mimes( $upload_mimes ) {
    $upload_mimes['ogv'] = 'image/svg+xml';
    $upload_mimes['svg'] = 'application/json';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );

function gs_login_logo(){ ?>
    <style type="text/css">

        @font-face {
            font-family: 'almoni_dl_aaaregular';
            src: url('assets/fonts/almoni-dl-aaa-regular-webfont.eot');
            src: url('assets/fonts/almoni-dl-aaa-regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('assets/fonts/almoni-dl-aaa-regular-webfont.woff2') format('woff2'),
            url('assets/fonts/almoni-dl-aaa-regular-webfont.woff') format('woff'),
            url('assets/fonts/almoni-dl-aaa-regular-webfont.ttf') format('truetype'),
            url('assets/fonts/almoni-dl-aaa-regular-webfont.svg#almoni_dl_aaaregular') format('svg');
            font-weight: normal;
            font-style: normal;

        }

        body {
            background: #87e4c2 !important;
            font-family: 'almoni_dl_aaaregular';
        }

        .login #login_error, .login .message {
            color: #fff;
            border-left: 4px solid #232f38 !important;
        }

        #login {
            direction: ltr;
        }

        .login #backtoblog a, .login #nav a {
            color: #fff !important;
        }

        .login form {
            background-color: #000 !important;
        }

        .login label {
            color: #fff !important;
        }

        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png);
            padding-bottom: 30px;
            width: 100%;
            height: 10px;
        }

        #login {
            padding-top: 15%;
        }

        .login .message {
            background-color: #d2002d !important;
        }

        .wp-core-ui .button-primary {
            background: #87e4c2 !important;
            color: #000 !important;
            box-shadow: none !important;
            text-shadow: none !important;
            border: none !important;
            border-radius: 0px !important;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'gs_login_logo');

function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function gs_wp_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
        $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
        $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}

function isRTL( $string ) {
	$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
	return preg_match($rtl_chars_pattern, $string);
}

function load_posts ($year, $month, $type){

	$args = array(
		'posts_per_page'   => 8,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => $type,
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'date_query' => array(
			array(
				'year'  => $year,
				'month' => $month
			),
		)
	);

	$items = get_posts( $args );
	$i = 1;

	foreach ( $items as $item ){ setup_postdata($item);

		if( $i <= 4 ){
			$words = 40;
			$class = 'style-1';
		}else{
			$words = 15;
			$class = 'style-2';
		}
		?>

        <a href="<?=get_permalink($item->ID); ?>" class="item animate fade-bottom <?=$class; ?>" data-delay="100">
            <div class="holder">
                <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($item->ID); ?>');">
                    <div class="holder">
						<?php if( $class == 'style-1'){ ?>
                            <span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
                            <h3><?=get_the_title($item->ID); ?></h3>
						<?php } ?>
                    </div>
                </div>
                <div class="text">
					<?php if( $class == 'style-2'){ ?>
                        <span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
                        <h3><?=get_the_title($item->ID); ?></h3>
					<?php } ?>
					<?php echo wp_trim_words($item->post_content, $words); ?>
                </div>
            </div>
        </a>

		<?php $i++; }
}

add_action( 'wp_ajax_nopriv_load-archive', 'ajax_load_archive' );
add_action( 'wp_ajax_load-archive', 'ajax_load_archive' );

function ajax_load_archive($year, $month, $post_type){
    $month = $_POST['month'];
    $year = $_POST['year'];
    $post_type= $_POST['post_type'];

	ob_start();

	$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'date_query' => array(
			array(
				'year'  => $year,
				'month' => $month
			),
		)
	);

	$items = get_posts( $args );
	$i = 1;

	foreach ( $items as $item ){ setup_postdata($item);

		if( $i <= 4 ){
			$class = 'style-1';
		}else{
			$class = 'style-2';
		}
		?>

        <a href="<?=get_permalink($item->ID); ?>" class="item animate fade-bottom <?=$class; ?>" data-delay="100">
            <div class="holder">
                <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($item->ID); ?>');">
                    <div class="holder">
						<?php if( $class == 'style-1'){ ?>
                            <span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
                            <h3><?=get_the_title($item->ID); ?></h3>
						<?php } ?>
                    </div>
                </div>
                <div class="text">
					<?php if( $class == 'style-2'){ ?>
                        <span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
                        <h3><?=get_the_title($item->ID); ?></h3>
					<?php } ?>
					<?php echo wp_trim_words($item->post_content, 18); ?>
                </div>
            </div>
        </a>

		<?php $i++; }

	$response = ob_get_contents();
	ob_end_clean();

	echo $response;
	exit();
}

add_action( 'wp_ajax_nopriv_shows-filter', 'ajax_shows_filter' );
add_action( 'wp_ajax_shows-filter', 'ajax_shows_filter' );

function ajax_shows_filter($filter_type){
	$filter_type = $_POST['filter_type'];

	ob_start();

	if( $filter_type == 'date'){

	    $args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'shows',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'meta_key' => 'date',
			'orderby' => 'meta_value',
			'order'            => 'ASC'
	    );

    }elseif( $filter_type == 'location'){

		$location = $_POST['location'];

		$args = array(
			'post_type'      => 'shows',
			'location' => $location,
            'posts_per_page' => - 1,
		);

    }elseif( $filter_type == 'artist'){

		$artist = $_POST['artist'];
		$meta_query = array( 'relation' => 'OR' );

        $meta_query[] = array(
            'key'     => 'assigned_artist',
            'value'   => $artist,
            'compare' => 'LIKE',
        );

		$args = array(
			'post_type'      => 'shows',
			'posts_per_page' => - 1,
			'meta_query'     => array( $meta_query ),
		);
	}

	$items = get_posts( $args );

	rewind_posts();

	if( $items != null ){

    	foreach ( $items as $post ){ setup_postdata($post);

	    	include( 'includes/item-shows.php');

		$i++; }

	}else{
	    echo 'No Results';
    }

	$response = ob_get_contents();
	ob_end_clean();

	echo $response;
	exit();
}

add_filter( 'posts_orderby', 'order_search_by_posttype', 10, 1 );
function order_search_by_posttype( $orderby ){
	if( ! is_admin() && is_search() ) :
		global $wpdb;
		$orderby =
			"
            CASE WHEN {$wpdb->prefix}posts.post_type = 'news' THEN '1' 
                 WHEN {$wpdb->prefix}posts.post_type = 'post' THEN '2' 
                 WHEN {$wpdb->prefix}posts.post_type = 'shows' THEN '3' 
                 WHEN {$wpdb->prefix}posts.post_type = 'productions' THEN '4' 
            ELSE {$wpdb->prefix}posts.post_type END ASC, 
            {$wpdb->prefix}posts.post_title ASC";
	endif;
	return $orderby;
}

/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
	global $wpdb;

	if ( is_search() ) {
		$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}

	return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
	global $pagenow, $wpdb;

	if ( is_search() ) {
		$where = preg_replace(
			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
	}

	return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
	global $wpdb;

	if ( is_search() ) {
		return "DISTINCT";
	}

	return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

?>