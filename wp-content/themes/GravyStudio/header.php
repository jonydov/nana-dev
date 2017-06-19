<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title><?php wp_title(); ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.png"/>

    <?php echo get_field('header_scripts', 'option'); ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="wrapper">

    <header data-offset-top="0" data-spy="scroll" data-target=".white-section">
        <div class="shell">
            <a class="logo" href="<?php bloginfo('url'); ?>">
                <img src="<?php bloginfo('template_url'); ?>/assets/images/logo-dg.png" />
            </a>

            <nav class="navbar">
                <div class="tagline">
                    <span class="phone">0522-889776</span>
                </div>
                <div class="nav-holder">
	                <?php
	                wp_nav_menu(array(
			                'theme_location' => 'main-menu',
			                'depth' => 1,
			                'container' => false,
			                'fallback_cb' => 'wp_page_menu',
			                'menu_class' => 'main-nav cf',
			                'walker' => new wp_bootstrap_navwalker())
	                );

	                wp_nav_menu(array(
			                'theme_location' => 'locations-menu',
			                'depth' => 1,
			                'container' => false,
			                'fallback_cb' => 'wp_page_menu',
			                'menu_class' => 'locations-nav cf',
			                'walker' => new wp_bootstrap_navwalker())
	                );

	                wp_nav_menu(array(
			                'theme_location' => 'contact-menu',
			                'depth' => 1,
			                'container' => false,
			                'fallback_cb' => 'wp_page_menu',
			                'menu_class' => 'contact-nav cf',
			                'walker' => new wp_bootstrap_navwalker())
	                );
	                ?>
                </div>
            </nav>

            <button class="c-hamburger c-hamburger--htx show-mobile">
                <span>toggle menu</span>
            </button>
        </div>
    </header>