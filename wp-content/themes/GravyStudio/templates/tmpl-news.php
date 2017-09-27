<?php
/*
    Template Name: חדשות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'news_archive' ) { ?>

		<section class="section-news-archive animate fade-bottom" data-delay="100">

			<div class="shell">
				<div class="section-header">
					<h1>מה חדש?</h1>
				</div>

				<div class="section-body">

                    <div class="archive-list">
	                    <?php dynamic_sidebar('news-archives') ?>
                    </div>

					<div class="items items-news">

						<?php
							$args = array(
								'posts_per_page'   => -1,
								'orderby'          => 'title',
								'order'            => 'ASC',
								'post_type'        => 'news',
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

							<a href="<?=get_permalink($item->ID); ?>" class="item <?=$class; ?>">
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

					</div>
				</div>
			</div>

		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
