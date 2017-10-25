<?php
/*
    Template Name: הופעות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'shows_slider' ) { ?>

		<section class="section-shows-banner-slider">

			<?php if ( get_sub_field( 'title' ) != null ) { ?>
				<div class="shell">
					<div class="section-title">
						<h1><?php the_sub_field( 'title' ); ?></h1>
					</div>
				</div>
			<?php } ?>

			<?php if ( get_sub_field( 'items' ) != null ) { ?>

				<div class="items">
					<?php while ( have_rows( 'items' ) ) : the_row(); ?>

						<div class="item"
						     <?php if ( get_sub_field( 'image' ) != null ){ ?>style="background-image: url('<?php the_sub_field( 'image' )['image']; ?>');"<?php } ?>>

							<?php if ( get_sub_field( 'button' ) != null ) {
								$btn = get_sub_field( 'button' ); ?>
								<a href="<?= $btn['url']; ?>" target="<?= $btn['target']; ?>"><?= $btn['text']; ?></a>
							<?php } ?>

						</div>
					<?php endwhile; ?>
				</div>

			<?php } ?>
		</section>
	<?php } elseif ( get_row_layout() == 'shows_schedule' ) { ?>

		<section class="section-shows-schedule">

			<div class="shell">

				<div class="section-body">

					<div class="holder">
						<nav class="nav-cat">
							<span>מיון לפי:</span>
							<ul class="cat-types" data-filter-group="album-type">
								<li class="cat is-checked" data-filter="date">תאריך</li>
								<li class="cat" data-filter="artist">שם האמן</li>
								<li class="cat" data-filter="location">מקום</li>
							</ul>
						</nav>

						<div class="artists">
							<div class="artists-slider">
								<?php
								$args = array(
									'post_type' => 'artists',
									'posts_per_page' => -1,
								);

								$posts = get_posts($args);

								$i = 1;
								$c = count($posts);
								$m = 5;

								foreach ($posts as $post){
									if( $i == 1 ){ echo '<div class="col">'; }
									if( $i % 5 == 0 ){ echo '</div><div class="col">'; }
									echo '<a href="'.get_permalink($post->ID).'"><span>'.$post->post_title.'</span></a>';
									if( $i == $c ){ echo '</div>'; }
									$i++;
								} wp_reset_postdata();
								?>
							</div>
						</div>

						<div class="items shows-filter cf">

							<?php

							$args = array(
								'post_type' => 'shows',
								'posts_per_page' => -1,
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
									<div class="item">
										<span class="date"><?=$date; ?></span>
										<span class="time"><?=get_field('time', $post->ID); ?> | </span>
										<span class="artist">
											<?php
												$artists       = get_field( 'assigned_artist', $post->ID );
												$artists_names = array();
												foreach ( $artists as $artist ) {
													$artists_names[] = get_the_title( $artist );
												}
												echo implode(", ", $artists_names).' - ';
											?>
										</span>
										<span class="venue"><?=get_field('venue', $post->ID); ?></span>
										<span class="desc">, <?=get_the_title($post->ID); ?></span>
										<span class="tix"><a target="_blank" href="<?=get_field('link', $post->ID); ?>">כרטיסים</a></span>
									</div>
								<?php } ?>

							<?php } wp_reset_postdata(); ?>

						</div>
					</div>

				</div>
			</div>

		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
