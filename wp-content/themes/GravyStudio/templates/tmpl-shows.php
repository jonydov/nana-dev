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
						<nav class="nav-cat filter-shows">
							<span>מיון לפי:</span>
							<ul class="cat-types">
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
									echo '<a data-artist="'.$post->ID.'" class="artist" href="#"><span>'.$post->post_title.'</span></a>';
									if( $i == $c ){ echo '</div>'; }
									$i++;
								} wp_reset_postdata();
								?>
							</div>
						</div>

                        <div class="locations">
							<div class="locations-slider">
								<?php
								$args = array(
									'post_type' => 'shows',
									'taxonomy' => 'location',
									'posts_per_page' => -1,
								);

								$posts = get_terms($args);

								$i = 1;
								$c = count($posts);
								$m = 5;

								foreach ($posts as $post){
									if( $i == 1 ){ echo '<div class="col">'; }
									if( $i % 5 == 0 ){ echo '</div><div class="col">'; }
									echo '<a data-location="'.$post->slug.'" class="location" href="#"><span>'.$post->name.'</span></a>';
									if( $i == $c ){ echo '</div>'; }
									$i++;
								} wp_reset_postdata();
								?>
							</div>
						</div>

                        <div class="sk-folding-cube fade-bottom" id="preloader">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>

						<div class="items shows-filter cf fade-bottom on">

							<?php

                                $args = array(
                                    'post_type' => 'shows',
                                    'posts_per_page' => -1,
                                    'meta_key' => 'date',
                                    'orderby' => 'meta_value',
                                    'order' => 'ASC'
                                );

                                $posts_array = get_posts( $args );

							?>

							<?php foreach ( $posts_array as $post ) { ?>

								<?php get_template_part( 'includes/item-shows'); ?>

							<?php } wp_reset_postdata(); ?>
						</div>

					</div>
				</div>
			</div>

		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
