<?php
/*
    Template Name: אמנים
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'artists_grid' ) { ?>

        <section class="section-artists">

            <div class="shell">

                <div class="section-title">
					<?php if ( get_sub_field( 'title' ) != null ) { ?>
                        <h2><?php the_sub_field( 'title' ); ?></h2>
					<?php } ?>
                </div>

                <div class="section-body affix-top" data-offset-top="150" data-spy="affix">

                    <nav id="links">
                        <ul class="alphabet-scale">

							<?php
							$args        = array(
								'posts_per_page'   => - 1,
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'artists',
								'post_status'      => 'publish',
								'suppress_filters' => true

							);
							$posts_array = get_posts( $args );

							$i = 0;

							foreach ( $posts_array as $post ) {

								if ( isRTL( $post->post_title ) == true ) {
									$artistsHe[] = $post->ID;
								} else {
									$artistsEn[] = $post->ID;
								}

							} ?>

	                        <?php foreach ($artistsHe as $post){

		                        if ( $i == 0 ) {
			                        $first_letter = mb_substr( get_the_title($post), 0, 1 );
			                        ?>
                                    <li class="letter lang-he active">
                                        <a href="#index-<?php echo $first_letter ?>"><span
                                                    class="letter"><?php echo $first_letter; ?></span></a>
                                    </li>
		                        <?php }

		                        $index_letter = mb_substr( get_the_title($post), 0, 1 );

		                        if ( strcasecmp( $index_letter, $first_letter ) != 0 ) {
			                        $first_letter = $index_letter; ?>
                                    <li class="letter lang-he active">
                                        <a href="#index-<?php echo $first_letter ?>"><span><?php echo $first_letter; ?></span></a>
                                    </li>
		                        <?php };

		                        $i = $i + 1;
	                        }
	                        ?>


                            <?php foreach ($artistsEn as $post){

		                        if ( $i == 0 ) {
			                        $first_letter = mb_substr( $post->post_title, 0, 1 );
			                        ?>
                                    <li class="letter lang-en">
                                        <a href="#index-<?php echo $first_letter ?>"><span
                                                    class="letter"><?php echo $first_letter; ?></span></a>
                                    </li>
		                        <?php }

		                        $index_letter = mb_substr( get_the_title($post), 0, 1 );

		                        if ( strcasecmp( $index_letter, $first_letter ) != 0 ) {
			                        $first_letter = $index_letter; ?>
                                    <li class="letter lang-en">
                                        <a href="#index-<?php echo $first_letter ?>"><span><?php echo $first_letter; ?></span></a>
                                    </li>
		                        <?php };

		                        $i = $i++;
	                        }
	                        ?>
                            <li class="lang-toggle">ABC</li>
                        </ul>
                    </nav>

                    <div class="items">

						<?php

                            $args = array(
                                'posts_per_page'   => - 1,
                                'orderby'          => 'title',
                                'order'            => 'ASC',
                                'post_type'        => 'artists',
                                'post_status'      => 'publish',
                                'suppress_filters' => true

                            );

                            $posts_array = get_posts( $args );

                            mb_internal_encoding( "UTF-8" );

                            $i = 0;

                            foreach ( $posts_array as $post ) {

                                if ( isRTL( $post->post_title ) == true ) {
                                    $artistsHe[] = $post->ID;
                                } else {
                                    $artistsEn[] = $post->ID;
                                }
                            }

						?>

						<?php foreach ( $artistsHe as $post ) { ?>

							<?php

                                if ( $i == 0 ) {

                                    $first_letter = mb_substr( get_the_title( $post ), 0, 1 );
                                    $index        = 'name="#index-' . $first_letter . '"';

                                } else {

                                    $index_letter = mb_substr( get_the_title( $post ), 0, 1 );

                                    if ( strcasecmp( $index_letter, $first_letter ) != 0 ) {
                                        $first_letter = $index_letter;

                                        $index = 'name="#index-' . $first_letter . '"';
                                    } else {

                                        $index = '';
                                    }
                                }

                                $img = get_the_post_thumbnail_url( $post );
							?>

                                <a href="<?php the_permalink( $post ); ?>" class="item" <?= $index; ?>>

                                    <div class="holder">
                                        <div class="image">
                                            <div class="holder" <?php if ( $img != null ) {
                                                echo 'style="background-image: url(' . $img . ');"';
                                            } ?>></div>
                                        </div>


                                        <div class="text">
                                            <span class="name-artist"><?= get_the_title( $post ); ?></span>
                                        </div>
                                    </div>
                                </a>

                        <?php $i = $i + 1; } ?>

                        <?php foreach ( $artistsEn as $post ) { ?>

							<?php

                                if ( $i == 0 ) {

                                    $first_letter = mb_substr( get_the_title( $post ), 0, 1 );
                                    $index        = 'name="#index-' . $first_letter . '"';

                                } else {

                                    $index_letter = mb_substr( get_the_title( $post ), 0, 1 );

                                    if ( strcasecmp( $index_letter, $first_letter ) != 0 ) {
                                        $first_letter = $index_letter;

                                        $index = 'name="#index-' . $first_letter . '"';
                                    } else {

                                        $index = '';
                                    }
                                }

                                $img = get_the_post_thumbnail_url( $post );
							?>

                                <a href="<?php get_permalink( $post ); ?>" class="item" <?= $index; ?>>

                                    <div class="holder">
                                        <div class="image">
                                            <div class="holder" <?php if ( $img != null ) {
                                                echo 'style="background-image: url(' . $img . ');"';
                                            } ?>></div>
                                        </div>


                                        <div class="text">
                                            <span class="name-artist"><?= get_the_title( $post ); ?></span>
                                        </div>
                                    </div>
                                </a>

                        <?php $i = $i + 1; } ?>

                    </div>

                </div>
            </div>

        </section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
