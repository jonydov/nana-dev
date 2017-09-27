<?php
    get_header();
    $id = get_queried_object()->ID;
?>

    <section class="section-artist-bio">
        <div class="shell">

            <div class="section-title">
                <h1><?=get_the_title(); ?></h1>
            </div>

            <div class="section-body">
                <div class="image">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" />
                    <?php } ?>
                    <div class="socials">

                        <?php $socials = get_field('links'); ?>

                        <?php if( $socials['facebook'] != null ){ ?>
                            <a href="<?=$socials['facebook']; ?>" class="ico-social">
                                <i class="zmdi zmdi-facebook-box"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['instagram'] != null ){ ?>
                            <a href="<?=$socials['instagram']; ?>" class="ico-social">
                                <i class="zmdi zmdi-instagram"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['twitter'] != null ){ ?>
                            <a href="<?=$socials['twitter']; ?>" class="ico-social">
                                <i class="zmdi zmdi-twitter"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['itunes'] != null ){ ?>
                            <a href="<?=$socials['itunes']; ?>" class="ico-social">
                                <i class="zmdi zmdi-itunes"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['apple_music'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['apple_music']; ?>" class="ico-social">
                                <i class="zmdi zmdi-apple"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['facebook'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['facebook']; ?>" class="ico-social">
                                <i class="zmdi zmdi-facebook"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['spotify'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['spotify']; ?>" class="ico-social">
                                <i class="zmdi zmdi-spotify"></i>
                            </a>
                        <?php } ?>

                        <?php if( $socials['youtube'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['youtube']; ?>" class="ico-social">
                                <i class="zmdi zmdi-youtube"></i>
                            </a>
                        <?php } ?>

                    </div>
                </div>
                <div class="text">
                    <div class="holder">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="section-upcoming-shows">
        <div class="shell">

            <div class="section-title">
                <h3>ההופעות הקרובות</h3>
            </div>

            <div class="section-body">
                <?php
                    $today = date('Ymd');

                    $args = array(
                        'posts_per_page'   => 5,
                        'orderby'          => 'title',
                        'order'            => 'ASC',
                        'post_type'        => 'shows',
                    );

                    $posts_array = get_posts( $args );
                ?>

                <?php foreach ( $posts_array as $post ) { ?>
                    <?php if (in_array($id, get_field('assigned_artist')) ) { ?>

                        <?php
                            $date = get_field('date', $post->ID);
                            $date = new DateTime($date);
                            $date = $date->format('j.m');
                        ?>

                        <?php if (strtotime($today) <= strtotime(get_field('date', $post->ID)) ) { ?>
                            <a href="<?php the_field('link', $post->ID); ?>" target="_blank">
                                <span class="date"><?=$date; ?>,</span>
                                <span class="time"><?=get_field('time', $post->ID); ?></span>
                                <span class="venue"><?=get_field('venue', $post->ID); ?></span>
                                <span class="desc">, <?=get_the_title($post->ID); ?></span>
                            </a>
                        <?php } ?>

                    <?php } ?>
                <?php } wp_reset_postdata(); ?>
            </div>

        </div>
    </section>

    <section class="section-albums-slider">
        <div class="shell">

            <div class="section-title">
                <h3>אלבומים</h3>
            </div>

            <div class="section-body albums-slider-holder">
                <?php
                $args = array(
                    'post_type' => 'albums',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'DESC',
                    'post_status'      => 'publish',
                    'suppress_filters' => true
                );

                $albums = get_posts( $args );

                foreach ( $albums as $post ) {
                    if ( in_array($id, get_field('assigned_artist', $post->ID)) ) {
                        $img = get_the_post_thumbnail_url( $post->ID );
                ?>

                    <a href="<?=get_permalink($post->ID); ?>" class="item">

                        <div class="holder">

                            <div class="image" <?php if( $img != null ){
                                echo 'style="background-image: url('.$img.');"'; } ?>>
                            </div>
                            <div class="text">
                                <span class="name-artist"><?=get_the_title($id); ?></span>
                                <span class="name-album"><?=$post->post_title; ?></span>
                            </div>
                        </div>
                    </a>

                <?php } } wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <section class="section-news">

        <div class="shell animate fade-bottom" data-delay="100">
            <div class="section-title">
                <h3>חדשות</h3>

                <a class="cta"
                <?php if( get_field('news_archive', 'option') != null ){ ?>
                     href="<?=get_field('news_archive', 'option'); ?>
                <?php } ?>
               ">עוד חדשות</a>
            </div>

            <div class="section-body">
                <div class="items">
                        <?php
                        $args = array(
                            'post_type' => 'news',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );

                        $i = 0;
                        $posts = get_posts($args);

                        foreach ($posts as $post){
                            if ( is_array(get_field('assigned_artist', $post->ID)) && in_array($id, get_field('assigned_artist', $post->ID)) && $i < 2 ) {
                        ?>
                            <a href="<?=get_permalink(); ?>" class="item">
                                <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                    <div class="holder"></div>
                                </div>
                                <div class="content">
                                    <span class="date"><?=get_the_time('d <b>בF</b>, Y'); ?></span>
                                    <h3><?=$post->post_title; ?></h3>
                                    <div class="text"><?php echo wp_trim_words($post->post_content, 25, '...'); ?></div>
                                </div>
                            </a>

                        <?php $i++; } } wp_reset_postdata(); ?>
                    </div>
            </div>

        </div>

    </section>

    <section class="section-feed-2cols">

        <div class="shell">

            <div class="col col-music animate fade-right" data-delay="100">
                <div class="holder">

                    <div class="section-title">
                        <h3>מוזיקה</h3>
                    </div>

                    <div class="section-body">
                        <?php the_field('music'); ?>
                    </div>

                </div>
             </div>

             <div class="col col-clips animate fade-left" data-delay="100">
                <div class="holder">

                    <div class="section-title">
                        <h3>וידאו</h3>
                        <a class="cta"
                        <?php if( get_field('clips_archive', 'option') != null ){ ?>
                            href="<?=get_field('clips_archive', 'option'); ?>
                        <?php } ?>

                         ">עוד קליפים</a>
                    </div>

                    <div class="items">

                        <?php
                        $args = array(
                            'post_type' => 'video-clips',
                            'posts_per_page' => 2,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'meta_query'	=> array(
                                'relation'		=> 'AND',
                                array(
                                    'key'	 	=> 'assigned_artist',
                                    'value'	  	=> array($post->ID),
                                )
                            ),
                        );

                        $videos = get_posts($args);

                        foreach ($videos as $post){
                            ?>

                            <a href="<?=get_field('youtube', $post->ID); ?>" class="item popup-yt">
                                <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                    <div class="holder"></div>
                                    <div class="text">
                                        <span class="name-vid"><?php the_title(); ?></span>
                                        <span class="name-artist"><?php the_field('artist_name', $post->ID); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php }
                        wp_reset_postdata(); ?>
                    </div>

                </div>
            </div>

        </div>


    </section>

    <section class="section-artist-gallery">
        <div class="shell">

            <div class="section-title">
                <h3>גלריה</h3>
            </div>

            <div class="section-body artist-gallery-slider-holder">
                <?php

                    $images = get_field('gallery', $id);

                    foreach ( $images as $image ) {

                ?>

                    <a href="<?=$image['url']; ?>" class="item popup-img">

                        <div class="holder">
                            <div class="image" <?php if( $image != null ){
                                echo 'style="background-image: url('.$image['sizes']['medium'].');"'; } ?>>
                            </div>
                        </div>
                    </a>

                <?php } ?>
            </div>
        </div>
    </section>

    <section class="section-other-artists">
        <div class="shell">

            <div class="section-title">
                <h3>אמנים נוספים</h3>
            </div>

            <div class="section-body">
                <div class="items">
	                <?php
                        $today = date('Ymd');

                        $args = array(
                            'posts_per_page'   => 6,
                            'orderby'          => 'rand',
                            'post_type'        => 'artists',
                        );

                        $posts_array = get_posts( $args );
	                ?>

	                <?php foreach ( $posts_array as $post ) { ?>

                        <a href="<?php the_permalink($post->ID); ?>" class="item">
                            <div class="holder" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID, 'medium'); ?>');">
                                <span class="name-artist"><?=get_the_title($post->ID); ?></span>
                            </div>
                        </a>

                    <?php } ?>
                </div>
            </div>
        </div>


    </section>


<?php get_footer(); ?>
