<?php

    define('TMPL_URL', dirname(__FILE__) . DIRECTORY_SEPARATOR);

    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Settings',
            'menu_title'	=> 'Theme Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

    }

    function gs_enqueue_scripts() {
        wp_enqueue_script('jQuery', get_template_directory_uri()."/assets/js/jquery-2.2.4.min.js");
        wp_enqueue_script('slick', get_template_directory_uri()."/assets/js/slick.min.js");
        wp_enqueue_script('skrollr', get_template_directory_uri()."/assets/js/skrollr.min.js");
        wp_enqueue_script('bootstrap', get_template_directory_uri()."/assets/js/bootstrap.min.js");
	    wp_enqueue_script('midnight' , get_stylesheet_directory_uri() . '/assets/js/midnight.jquery.min', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
	    wp_enqueue_script('functions_js' , get_stylesheet_directory_uri() . '/assets/js/functions.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
    }
    add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );

    if( !is_admin() ){

        wp_enqueue_style('slick_css', get_template_directory_uri()."/assets/css/slick.min.css");
        wp_enqueue_style('material_css', get_template_directory_uri()."/assets/css/material-design-iconic-font.min.css");
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

        @import url('https://fonts.googleapis.com/css?family=Open+Sans');

        body {
            background: #405566 !important;
        }

        .login #login_error, .login .message {
            color: #fff;
            border-left: 4px solid #232f38 !important;
        }

        #login {
            direction: ltr;
            font-family: 'Open Sans', sans-serif;
        }

        .login #backtoblog a, .login #nav a {
            color: #fff !important;
        }

        .login form {
            background-color: #232f38 !important;
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
            background: #000 !important;
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

?>