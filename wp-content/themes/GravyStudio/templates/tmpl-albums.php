<?php
/*
    Template Name: אלבומים
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'albums_grid' ) { ?>

		<section class="section-albums-by-year">
			<div class="shell">

			<h2><?php get_sub_field('title'); ?></h2>

				<div class="section-title">
					<?php if( get_sub_field('title') != null ){ ?>
						<h2><?php the_sub_field('title'); ?></h2>
					<?php } ?>
				</div>

			</div>

			<div class="albums-slider">
				ttt
			</div>


			<div class="shell">

				<div class="section-body affix-top" data-offset-top="150" data-spy="affix">

					<nav id="links">
						<ul class="years-scale">

							<?php
							$args = array(
								'posts_per_page'   => -1,
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'albums',
								'post_status'      => 'publish',
								'suppress_filters' => true

							);
							$posts_array = get_posts( $args );


							foreach ($posts_array as $post){

								$album_name = $post->post_title;
								?>

								<li class="year">
									<a href="#index-<?php echo $year ?>"><span class="letter"></span></a>
								</li>


								<?php
								 } ?>

						</ul>
					</nav>
					<div class="holder">
						<nav id="nav-cat">

							<ul class="cat-type">
								<li class="cat cat-title">
									מיון לפי
								</li>


								<?php
								$args = array(
									'posts_per_page'   => -1,
									'orderby'          => 'title',
									'order'            => 'ASC',
									'post_type'        => 'albums',
									'post_status'      => 'publish',
									'suppress_filters' => true

								);
								$posts_array = get_posts( $args );

								$argsCat = array(
									'orderby'          => 'name',
									'order'            => 'ASC',
									'separator'           => ',',
									'show_count'          => 0,
									'show_option_all'     => '',
									'show_option_none'    => __( 'No categories' ),
									'style'               => 'list',
									'taxonomy'            => 'categories',
									'title_li'            => __( 'Categories' ),
									'use_desc_for_title'  => 1
								);

								var_dump($argsCat);
								echo $argsCat->name;

									foreach ($posts_array as $post){
									?>

									<li class="cat">
										<a href="#index-<?php echo $year ?>"><span class="year"></span></a>
									</li>


									<?php
								} ?>

							</ul>
						</nav>
						<div class="items">

							<?php

							$args = array(
								'posts_per_page'   => -1,
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'albums',
								'post_status'      => 'publish',
								'suppress_filters' => true

							);


							$posts_array = get_posts( $args );

							foreach ($posts_array as $post){

								$img = get_the_post_thumbnail_url($post->ID);


	?>
								<a href="<?php get_permalink($post->ID); ?>"  class="item ">


								<div class="image">
									<div class="holder" <?php if( $img != null ){ echo 'style="background-image: url('.$img.');"'; } ?>></div>
								</div>

								</a>

								<?php
								} ?>



						</div>
					</div>

				</div>
			</div>

		</section>

	<?php }?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
