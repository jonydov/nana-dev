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
                        <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" />
                    <?php } ?>
                    <div class="socials">

                        <?php $socials = get_field('links'); ?>

                        <?php if( $socials['website'] != null ){ ?>
                            <a href="<?=$socials['website']; ?>">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['instagram'] != null ){ ?>
                            <a href="<?=$socials['instagram']; ?>">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['twitter'] != null ){ ?>
                            <a href="<?=$socials['twitter']; ?>">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['facebook'] != null ){ ?>
                            <a href="<?=$socials['facebook']; ?>">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['band_camp'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['band_camp']; ?>">
                                <i class="fa fa-bandcamp" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['itunes'] != null ){ ?>
                            <a href="<?=$socials['itunes']; ?>">
                                <i class="ico ico-it"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['apple_music'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['apple_music']; ?>">
                                <i class="fa fa-apple" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                        <?php if( $socials['spotify'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['spotify']; ?>">
                                <i class="fa fa-spotify" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
	                    <?php if( $socials['youtube'] != null ){ ?>
                            <a target="_blank" href="<?=$socials['youtube']; ?>">
                                <i class="fa fa-youtube-square" aria-hidden="true"></i>
                            </a>
	                    <?php } ?>

                    </div>
                </div>
                <div class="text">
                    <div class="holder">
                        <div class="scrollbar" id="style-2">
                            <div class="force-overflow">
	                            <?php the_content(); ?>
                            </div>
                        </div>
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
                        'post_type' => 'shows',
                        'posts_per_page' => 2,
                        'meta_query'	=> array(
                            array(
                                'key' => 'assigned_artist',
                                'value' => $id,
                                'compare' => 'LIKE'
                            )
                        ),
                    );

                    $posts_array = get_posts( $args );
                ?>

                <?php foreach ( $posts_array as $post ) { ?>

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

                <?php } wp_reset_postdata(); ?>
            </div>

        </div>
    </section>

    <section class="section-albums-slider">
        <div class="shell">

            <div class="section-title">
                <h3>אלבומים</h3>
            </div>

            <div class="section-body albums-slider-holder" dir="rtl">
                <?php
                $args = array(
	                'post_type' => 'albums',
	                'posts_per_page' => -1,
	                'meta_query'	=> array(
		                array(
			                'key' => 'assigned_artist',
			                'value' => $id,
			                'compare' => 'LIKE'
		                )
	                ),
                );

                $albums = get_posts( $args );

                foreach ( $albums as $post ) {
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
	                            <?php
	                            $date = get_field( 'publish_date', $post->ID );
	                            $date = str_replace( '/', '<span>', $date );
	                            $date = str_replace( '!', '</span>', $date );
	                            $date = substr($date, -4);
	                            ?>
                                <span class="date"><?= $date; ?></span>
                            </div>
                        </div>
                    </a>

                <?php } wp_reset_postdata(); ?>
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
	                        'posts_per_page' => 2,
	                        'meta_query'	=> array(
		                        array(
			                        'key' => 'assigned_artist',
			                        'value' => $id,
			                        'compare' => 'LIKE'
		                        )
	                        ),
                        );

                        foreach ($posts as $post){
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

                        <?php } wp_reset_postdata(); ?>
                    </div>
            </div>

        </div>

    </section>

    <section class="section-feed-2cols">

        <div class="shell">

            <div class="col col-music animate fade-bottom" data-delay="100">
                <div class="holder">

                    <div class="section-title">
                        <h3>מוזיקה</h3>
                    </div>

                    <div class="section-body">
                        <?php the_field('music'); ?>
                    </div>

                </div>
             </div>

             <div class="col col-clips animate fade-bottom" data-delay="100">
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
                            'meta_query'	=> array(
                                array(
	                                'key' => 'assigned_artist',
	                                'value' => $id,
	                                'compare' => 'LIKE'
                                )
                            ),
                        );

                        $videos = get_posts($args);

                        foreach ($videos as $post){ ?>

                            <a href="<?=get_field('youtube', $post->ID); ?>" data-title="" data-caption="" class="item popup-yt">
                                <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                    <div class="holder"></div>
                                    <div class="text">
                                        <span class="name-vid"><?php the_title(); ?></span>
                                        <span class="name-artist"><?php the_field('artist_name', $post->ID); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php } wp_reset_postdata(); ?>
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

            <div class="section-body artist-gallery-slider-holder" dir="rtl">
                <?php

                    $images = get_field('gallery', $id);

                    if( $images != null ){


                        foreach ( $images as $image ) {

                ?>

                        <a href="<?=$image['url']; ?>" class="item popup-img" data-effect="fadeInUp">

                            <div class="holder">
                                <div class="image" data-title="<?=$image['title']; ?>" data-caption="<?=$image['caption']; ?>" <?php if( $image != null ){
                                    echo 'style="background-image: url('.$image['sizes']['medium'].');"'; } ?>>
                                </div>
                            </div>
                        </a>

                    <?php } ?>
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
