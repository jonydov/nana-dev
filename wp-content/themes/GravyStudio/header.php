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

    <header data-offset-top="0" data-spy="affix">
        <div class="bg-holder"></div>
        <div class="search-bar">
            <div class="shell">
	            <?php get_search_form(); ?>
            </div>
        </div>
        <div class="shell">

            <nav class="navbar">

                <a class="logo" href="<?php bloginfo('url'); ?>">
                    <?php
                        if( is_page_template('templates/tmpl-hp.php') ){
                            $logo = get_field('logo', 'option');
                        }else{
	                        $logo = get_field('logo_dark', 'option');
                        }
                    ?>
                    <img src="<?php echo $logo; ?>" />
                </a>

                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'depth' => 2,
                        'container' => false,
                        'fallback_cb' => 'wp_page_menu',
                        'menu_class' => 'main-nav',
                        'walker' => new wp_bootstrap_navwalker())
                    );
                ?>

                <ul class="socials hide-mobile">
                    <?php if( get_field('youtube', 'option') != null ){ ?>
                        <li>
                            <a href="<?=get_field('youtube', 'option'); ?>">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php } ?>
	                <?php if ( get_field( 'spotify', 'option' ) != null ) { ?>
                        <li>
                            <a target="_blank" href="<?= get_field( 'spotify', 'option' ); ?>" class="ico-social">
                                <i class="fa fa-spotify" aria-hidden="true"></i>
                            </a>
                        </li>
	                <?php } ?>
	                <?php if ( get_field( 'apple', 'option' ) != null ) { ?>
                        <li>
                            <a href="<?= get_field( 'apple', 'option' ); ?>">
                                <i class="fa fa-apple" aria-hidden="true"></i>
                            </a>
                        </li>
	                <?php } ?>
                    <?php if( get_field('instagram', 'option') != null ){ ?>
                        <li>
                            <a href="<?=get_field('instagram', 'option'); ?>">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if( get_field('twitter', 'option') != null ){ ?>
                        <li>
                            <a href="<?=get_field('twitter', 'option'); ?>">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if( get_field('facebook', 'option') != null ){ ?>
                        <li>
                            <a href="<?=get_field('facebook', 'option'); ?>">
                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php } ?>

                </ul>

                <button class="btn btn-search hide-mobile">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </nav>

            <button class="c-hamburger c-hamburger--htx show-mobile">
                <span>toggle menu</span>
            </button>
        </div>
    </header>