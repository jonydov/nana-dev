<?php
/*
    Template Name: אלבומים
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'albums_slider' ) { ?>

        <section class="section-albums-banner-slider">

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
	<?php } elseif ( get_row_layout() == 'albums_grid' ) { ?>

        <section class="section-albums-list">
            <div class="shell">

                <div class="section-title">
					<?php if ( get_sub_field( 'title' ) != null ) { ?>
                        <h2><?php the_sub_field( 'title' ); ?></h2>
					<?php } ?>
                </div>

            </div>

            <div class="shell">

                <nav id="links">
                    <ul class="years">
						<?php

						echo '<li class="cat year is-checked" data-filter="*"><span>הכל</span></li>';

						$posts = get_posts(array(
							'posts_per_page'   => - 1,
                            'meta_key'			=> 'publish_date',
                            'orderby'			=> 'meta_value',
                            'order'				=> 'DESC',
                            'post_type'        => 'albums',
                            'post_status'      => 'publish',
                            'suppress_filters' => true
                            )
                        );

						$years_arr = array();

	                    foreach ( $posts as $post ) {

		                    $date = get_field('publish_date', $post->ID);

                            $years_arr[] = substr($date, -4);
	                    } wp_reset_postdata();

                        $years_arr = array_unique ($years_arr);
						foreach ( $years_arr as $item ) {

							echo '<li class="cat year" data-filter=".year-' . $item . '"><span>' . $item . '</span></li>';
	                    }

	                    ?>
                    </ul>
                </nav>

                <div class="section-body affix-top" data-offset-top="150" data-spy="affix">

                    <div class="holder">
                        <nav class="nav-cat">
                            <span>מיון לפי:</span>
                            <ul class="cat-types" data-filter-group="album-type">

                                <li class="cat is-checked" data-filter="*">הכל</li>

								<?php
								$args = array(
									'posts_per_page'   => - 1,
									'orderby'          => 'title',
									'order'            => 'ASC',
									'post_type'        => 'albums',
									'post_status'      => 'publish',
									'suppress_filters' => true

								);

								$albums = get_posts( $args );

								$args = array(
									'orderby'            => 'name',
									'order'              => 'ASC',
									'separator'          => ',',
									'show_count'         => 0,
									'show_option_all'    => '',
									'show_option_none'   => __( 'No categories' ),
									'style'              => 'list',
									'taxonomy'           => 'categories',
									'title_li'           => __( 'Categories' ),
									'use_desc_for_title' => 1
								);

								$terms = get_terms( 'album-type' );

								foreach ( $terms as $term ) {
									?>

                                    <li class="cat" data-filter=".<?php echo $term->slug; ?>">
										<?php echo $term->name; ?>
                                    </li>

								<?php } ?>

                            </ul>
                        </nav>

                        <div class="items items-filter cf">

							<?php

							$args = array(
								'posts_per_page'   => - 1,
								'meta_key'         => 'publish_date',
								'orderby'          => 'meta_value',
								'order'            => 'DESC',
								'post_type'        => 'albums',
								'post_status'      => 'publish',
								'suppress_filters' => true

							);

							$posts_array = get_posts( $args );

							foreach ( $posts_array as $post ) {

								$img    = get_the_post_thumbnail_url( $post->ID );
								$terms  = wp_get_post_terms( $post->ID, 'album-type' );
								$terms2 = wp_get_post_terms( $post->ID, 'year' );

								$types = array();

								foreach ( $terms as $term ) {
									$types[] = $term->slug;
								}

								$years = array();

								foreach ( $terms2 as $term ) {
									$years[] = 'year-' . $term->slug;
								}
								?>

                                <a href="<?= get_permalink( $post->ID ); ?>"
                                   class="item cf <?php echo implode( ' ', $types ); ?> <?php echo implode( ' ', $years ); ?>">


                                    <div class="image">
                                        <div class="holder" <?php if ( $img != null ) {
											echo 'style="background-image: url(' . $img . ');"';
										} ?>></div>
                                        <div class="text">

											<?php
											$artists       = get_field( 'assigned_artist', $post->ID );
											$artists_names = array();
											foreach ( $artists as $artist ) {
												$artists_names[] = get_the_title( $artist );
											}
											?>

                                            <span class="name-artist"><?php echo implode( ', ', $artists_names ); ?></span>
                                            <span class="name-album"><?= $post->post_title; ?></span>
											<?php
											$date = get_field( 'publish_date', $post->ID );
											$date = str_replace( '/', '<span>', $date );
											$date = str_replace( '!', '</span>', $date );
											if( get_field('only_year') == 1){
												$date = substr($date, -4);
                                            }
											?>
                                            <span class="date"><?= $date; ?></span>
                                            <span class="cta">לאלבום</span>
                                        </div>
                                    </div>

                                </a>

								<?php
							} ?>

                        </div>
                    </div>

                </div>
            </div>

        </section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
