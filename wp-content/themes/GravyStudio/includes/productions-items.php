<?php
	$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_type'        => 'productions',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'date_query' => array(
			array(
				'year'  => get_the_date('Y'),
				'month' => get_the_date('m')
			),
		)
	);

	$items = get_posts( $args );
	$i = 1;

	foreach ( $items as $item ){ setup_postdata($item);

		if( $i <= 4 ){
			$class = 'style-1';
		}else{
			$class = 'style-2';
		}
		?>

		<a href="<?=get_permalink($item->ID); ?>" class="item animate fade-bottom <?=$class; ?>" data-delay="100">
			<div class="holder">
				<div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($item->ID); ?>');">
					<div class="holder">
						<?php if( $class == 'style-1'){ ?>
							<span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
							<h3><?=get_the_title($item->ID); ?></h3>
						<?php } ?>
					</div>
				</div>
				<div class="text">
					<?php if( $class == 'style-2'){ ?>
						<span class="meta"><?=get_the_time('d בF Y' ,$item->ID); ?></span>
						<h3><?=get_the_title($item->ID); ?></h3>
					<?php } ?>
					<?php echo wp_trim_words($item->post_content, 18); ?>
				</div>
			</div>
		</a>

<?php $i++; } ?>