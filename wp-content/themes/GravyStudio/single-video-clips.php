<?php
get_header();
$post = get_queried_object();
$id   = get_queried_object()->ID;


?>

<section class="section-news-item">
	<div class="shell">

		<div class="section-body">

			<?php
                $artists = get_field( 'assigned_artist', $post->ID );
                $artists_names = array();
                foreach ( $artists as $artist ) {
                    $artists_names[] = get_the_title( $artist );
                }
			    $artists = implode( ", ", $artists_names );
			?>

			<div class="title"><h3><?= get_the_title(); ?> | <?php echo $artists; ?></h3></div>

			<div class="text">
				<div class="holder">
					<?php if ( get_field( 'youtube' ) != null ) { ?>
					<iframe width="100%" height="420" src="https://www.youtube.com/embed/<?= get_field( 'youtube' ); ?>?rel=0"
					        frameborder="0" allowfullscreen></iframe>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>
</section>


<?php get_footer(); ?>
