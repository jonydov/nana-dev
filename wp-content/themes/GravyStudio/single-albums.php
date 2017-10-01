<?php
get_header();
$id = get_queried_object()->ID;
?>

<section class="section-albums-info">
    <div class="shell">

        <div class="section-body cols3">

            <div class="col col-purchase">
				<?php if ( has_post_thumbnail( $id ) ) { ?>
                    <img class="image" src="<?= get_the_post_thumbnail_url( $id ); ?>"/>
				<?php } ?>

				<?php if ( get_field( 'links', $id ) != null ) {
					$links = get_field( 'links', $id ); ?>
                    <div class="items links-physical">

                        <div class="label">רכישה פיזית</div>

                        <div class="links">
							<?php if ( $links['link_cd'] != null ) { ?>
                                <a class="link link-cd" href="<?= $links['link_cd']; ?>" target="_blank">CD</a>
							<?php } ?>

							<?php if ( $links['link_vinyl'] != null ) { ?>
                                <a class="link link-vinyl" href="<?= $links['link_vinyl']; ?>" target="_blank">VINYL</a>
							<?php } ?>
                        </div>

                    </div>

                    <div class="items links-digital">

                        <div class="label">הורדה דיגיטלית</div>

                        <div class="links">
							<?php if ( $links['link_itunes'] != null ) { ?>
                                <a class="link link-itunes" href="<?= $links['link_itunes']; ?>"
                                   target="_blank">ITUNES</a>
							<?php } ?>

							<?php if ( $links['link_bandcamp'] != null ) { ?>
                                <a class="link link-bc" href="<?= $links['link_bandcamp']; ?>" target="_blank">BC</a>
							<?php } ?>
                        </div>

                    </div>

                    <div class="items links-listen">

                        <div class="label">האזנה</div>

                        <div class="links">
							<?php if ( $links['link_google_play'] != null ) { ?>
                                <a class="link link-google-play" href="<?= $links['link_google_play']; ?>"
                                   target="_blank">GOOGLE</a>
							<?php } ?>

							<?php if ( $links['link_spotify'] != null ) { ?>
                                <a class="link link-spotify" href="<?= $links['link_spotify']; ?>" target="_blank">SPOTIFY</a>
							<?php } ?>

							<?php if ( $links['link_apple'] != null ) { ?>
                                <a class="link link-apple" href="<?= $links['link_apple']; ?>" target="_blank">APPLE</a>
							<?php } ?>

							<?php if ( $links['link_deezer'] != null ) { ?>
                                <a class="link link-deezer" href="<?= $links['link_deezer']; ?>"
                                   target="_blank">DEEZER</a>
							<?php } ?>
                        </div>

                    </div>
				<?php } ?>
            </div>

			<?php if ( get_field( 'items' ) != null ) {
				$items = get_field( 'items' ); ?>
                <div class="col col-songs-list">
                    <div class="section-title">
                        <h1 class="black"><?= get_the_title( $id ); ?></h1>
                        <div class="text"><?= get_field( 'description', $id ); ?></div>
                    </div>

                    <ul>
						<?php $i = 1;
						foreach ( $items as $post ) { ?>
                            <li class="item">
                                <span class="number"><?= $i; ?>.</span>
                                <span class="title"><?= $post['title']; ?></span>
                                <span class="duration"><?= $post['duration']; ?></span>
                            </li>
							<?php $i ++;
						} ?>
                    </ul>
                </div>
			<?php } ?>

			<?php

			$artists    = get_field( 'assigned_artist', $id );
			$meta_query = array( 'relation' => 'OR' );

			foreach ( $artists as $value ) {
				$meta_query[] = array(
					'key'     => 'assigned_artist',
					'value'   => $value,
					'compare' => 'LIKE',
				);
			}

			$args = array(
				'post_type'      => 'albums',
				'posts_per_page' => - 1,
				'meta_query'     => array( $meta_query ),
			);

			$albums = get_posts( $args );

			if ( $albums != null ) {
				?>
                <div class="col col-more-albums">

                    <div class="section-title">
                        <h3>עוד אלבומים</h3>
                    </div>

                    <div class="items">

						<?php foreach ( $albums as $post ) { ?>

                            <a class="item" href="<?= get_permalink( $post->ID ); ?>">
                                <div class="holder">
									<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
                                        <img class="image" src="<?= get_the_post_thumbnail_url( $post->ID ); ?>"/>
									<?php } ?>

                                    <div class="text">
										<?php
										$artists       = get_field( 'assigned_artist', $post->ID );
										$artists_names = array();
										foreach ( $artists as $artist ) {
											$artists_names[] = get_the_title( $artist );
										}
										?>
                                        <span class="name-album">
                                            <span class="name-artist"><?php echo implode( ',', $artists_names ); ?></span>
											<?php echo get_the_title( $post->ID ); ?>
                                        </span>
                                    </div>
                                </div>
                            </a>

						<?php } ?>

                    </div>

                </div>

			<?php } ?>

        </div>

    </div>
</section>

<section class="section-album-text">
    <div class="shell">

        <div class="section-body">
			<?php the_field( 'text' ); ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
