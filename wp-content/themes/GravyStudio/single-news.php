<?php
get_header();
$post = get_queried_object();
$id   = get_queried_object()->ID;


?>

<section class="section-news-item">
    <div class="shell">

        <div class="section-top-bunner">

			<?php if ( has_post_thumbnail() ) {
				$img = get_the_post_thumbnail_url(); ?>
                <div class="image" style="background-image: url('<?php echo $img; ?>');"></div>
			<?php } ?>

        </div>

        <div class="section-body">

            <div class="title"><h3><?= get_the_title(); ?></h3></div>
            <span class="date"><?= get_the_time( 'd בF, Y' ); ?></span>

            <div class="text">
                <div class="holder">
					<?= $post->post_content; ?>
                </div>
            </div>

            <div class="tag-list">
				<?php
				if ( get_the_tag_list() ) {
					echo get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
				}
				?>
            </div>

        </div>

    </div>
</section>


<section class="section-music">

    <div class="shell">

        <div class="holder">

            <div class="section-body">
				<?php
				if ( get_field( 'music' ) != null ) {
					echo get_field( 'music' );
				}

				if ( get_field( 'youtube' ) != null ) { ?>
                    <iframe width="100%" height="420" src="https://www.youtube.com/embed/<?= get_field( 'youtube' ); ?>?rel=0"
                            frameborder="0" allowfullscreen></iframe>
				<?php } ?>
            </div>

        </div>

    </div>

</section>


<?php get_footer(); ?>
