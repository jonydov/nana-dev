<div class="shell">
	<div class="artists main-artists-slider fade-top animate on" data-delay="100">
		<div class="artists-slider" dir="rtl">
			<?php
			$args = array(
				'post_type'      => 'artists',
				'posts_per_page' => - 1,
			);

			$posts = get_posts( $args );

			$i = 1;
			$c = count( $posts );
			$m = 5;

			foreach ( $posts as $post ) {
				if ( $i == 1 ) {
					echo '<div class="col">';
				}
				if ( $i % 5 == 0 ) {
					echo '</div><div class="col">';
				}
				echo '<a href="' . get_permalink( $post->ID ) . '"><span>' . $post->post_title . '</span></a>';
				if ( $i == $c ) {
					echo '</div>';
				}
				$i ++;
			}
			wp_reset_postdata();
			?>
		</div>
		<?php if ( get_sub_field( 'link_text' ) != null ) { ?>
			<a class="cta"
			   href="<?= get_sub_field( 'link_url' ); ?>"><?= get_sub_field( 'link_text' ); ?></a>
		<?php } ?>
	</div>
</div>