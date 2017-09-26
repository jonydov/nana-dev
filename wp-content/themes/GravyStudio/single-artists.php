<?php
    get_header();
?>

<section class="section-artist-bio">
	<div class="shell">

        <div class="section-title">
            <h1><?=get_the_title(); ?></h1>
        </div>

        <div class="section-body">
            <div class="text">
                <?php the_content(); ?>
            </div>
            <div class="image">
                <?php if ( has_post_thumbnail() ) { ?>
	                <img src="<?php the_post_thumbnail_url(); ?>" />
                <?php } ?>
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

                    'meta_query'	=> array(
	                    'relation'		=> 'AND',
	                    array(
		                    'key'	 	=> 'assigned_artist',
		                    'value'	  	=> array($post->ID),
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

                <?php if (strtotime($today) <= strtotime( get_field('date', $post->ID) ) ) { ?>
                    <a href="<?php the_field('link', $post->ID); ?>" target="_blank">
                        <span class="date"><?=$date; ?></span>
                        <span class="time"><?=get_field('time', $post->ID); ?></span>
                        <span class="venue"><?=get_field('venue', $post->ID); ?></span>
                        <span class="venue"><?=get_the_title($post->ID); ?></span>
                    </a>
                <?php } ?>

            <?php }
            wp_reset_postdata();
            ?>
        </div>

	</div>
</section>

<section class="section-albums-slider">
    <div class="shell">

        <div class="section-title">
            <h3>אלבומים</h3>
        </div>

        <div class="section-body">

          <div class="albums-slider-holder">

            <?php
            $args = array(
                'post_type' => 'albums',
                'posts_per_page' => 4,
                'orderby' => 'title',
                'order' => 'DESC',
                'post_status'      => 'publish',
                'suppress_filters' => true,
                'meta_query'	=> array(
                    'relation'		=> 'AND',
                    array(
                        'key'	 	=> 'assigned_artist',
                        'value'	  	=> array($post->ID),
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
                            echo 'style="background-image: url('.$img.');"'; } ?>></div>
                        <div class="text">
                            <span class="name-album"><?=$post->post_title; ?></span>

                        </div>
                    </div>
                </a>

            <?php }
              wp_reset_postdata();
              ?>
          </div>
        </div>
    </div>
</section>

<section class="section-news">

    <div class="shell">
        <div class="section-title">
            <h3>חדשות</h3>
            <a class="cta" href="<?=get_sub_field('col_right_link_url'); ?>">עוד חדשות</a>

        </div>

        <div class="section-body">
            <div class="items">
                    <?php
                    $args = array(
                        'post_type' => 'news',
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

                    $posts = get_posts($args);


                    foreach ($posts as $post){
                        ?>

                        <a href="<?=get_permalink(); ?>" class="item">
                            <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                <div class="holder"></div>
                            </div>
                            <div class="content">
                                <span class="date"><?=get_the_time('d <b>בF</b>, Y'); ?></span>
                                <h3><?=$post->post_title; ?></h3>
                                <div class="text"><?php echo wp_trim_words($post->post_content, 12, '...'); ?></div>
                            </div>
                        </a>

                    <?php } wp_reset_postdata(); ?>
                </div>
        </div>

    </div>

</section>

<section class="section-feed-2cols">

    <div class="shell">

        <div class="col music animate fade-right" data-delay="100">
            <div class="holder">

                <div class="col-title">
                    <h3>מוזיקה</h3>
                </div>

                <div class="music">
                    <?php if( get_sub_field('spotify') != null ){?>
                        <a class="spotify" href="<?=get_sub_field('spotify'); ?>">
                            <?=get_sub_field('spotify'); ?></a>
                    <?php } ?>
                    <?php if( get_sub_field('apple music') != null ){ ?>
                        <a class="apple" href="<?=get_sub_field('apple'); ?>">
                            <?=get_sub_field('apple'); ?></a>
                    <?php } ?>
                </div>

                <?php wp_reset_postdata(); ?>

            </div>
         </div>

         <div class="col clips animate fade-left" data-delay="100">
            <div class="holder">

                <div class="col-title">
                    <h3>וידאו</h3>
                    <a class="cta" href="<?=get_sub_field('col_right_link_url'); ?>">עוד קליפים</a>

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
                                    <span class="vid-name"><?php the_title(); ?></span>
                                    <span class="artist-name"><?php the_field('artist_name', $post->ID); ?></span>
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

<?php if ( get_row_layout() == 'gallery' ) { ?>
<section class="section-gallery-slider">
    <div class="shell">

        <div class="section-title">
            <h3>גלריה</h3>
        </div>

        <div class="section-body">
            <div class="Gallery">

            </div>
        </div>
    </div>

</section>
<?php }     ?>

<section class="section-other-artists">
    <div class="shell">

        <div class="section-title">
            <h3>אמנים נוספים</h3>
        </div>

        <div class="section-body">
            <div class="other-artists-holder">

            </div>
        </div>
    </div>


</section>


<?php get_footer(); ?>
