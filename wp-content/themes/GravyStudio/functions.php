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

    function gs_enqueue_scripts() {
        wp_enqueue_script('jQuery', get_template_directory_uri()."/assets/js/jquery-2.2.4.min.js");
        wp_enqueue_script('slick', get_template_directory_uri()."/assets/js/slick.min.js");
        wp_enqueue_script('skrollr', get_template_directory_uri()."/assets/js/skrollr.min.js");
        wp_enqueue_script('bootstrap', get_template_directory_uri()."/assets/js/bootstrap.min.js");
	    wp_enqueue_script('magnific-js' , get_stylesheet_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
	    wp_enqueue_script('isotope-js' , get_stylesheet_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
	    wp_enqueue_script('functions-js' , get_stylesheet_directory_uri() . '/assets/js/functions.js', array('jquery'),  filemtime(getcwd().'/wp-content/themes/GravyStudio/assets/js/functions.js') , false );
    }
    add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );

    if( !is_admin() ){
        wp_enqueue_style('magnific-css', get_template_directory_uri()."/assets/css/magnific-popup.min.css");
        wp_enqueue_style('slick-css', get_template_directory_uri()."/assets/css/slick.min.css");
        wp_enqueue_style('bootstrap-css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
        wp_enqueue_style('material-css', get_template_directory_uri()."/assets/css/material-design-iconic-font.min.css");
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

add_action('wp_ajax_load-news', 'ajax_load_news');

function load_news($year, $month){

	$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => 'news',
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
}

function ajax_load_news($year, $month){
	$month = $_POST['month'];
	$year = $_POST['year'];
    load_news($year, $month);
}

?>