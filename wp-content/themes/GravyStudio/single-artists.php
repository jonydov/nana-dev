<?php
get_header();

$banner_img = get_field('blog_archive_banner_image', 'option');
$banner_title = get_field('blog_archive_banner_title', 'option');
$type = 'post';

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
            <h2>ההופעות הקרובות</h2>
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

            <?php } ?>
        </div>

	</div>
</section>

<?php get_footer(); ?>
