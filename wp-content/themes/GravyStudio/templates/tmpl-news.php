<?php
/*
    Template Name: חדשות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'news_archive' ) { ?>

        <section class="section-news-archive" data-current-url="<?php the_permalink(); ?>">
            <div class="archive">
                <div class="shell">
                    <div class="section-header">
                        <h1>מה חדש?</h1>
                    </div>

                    <div class="section-body">

                        <div class="archive-list">
							<?php dynamic_sidebar( 'news-archives' ) ?>
                        </div>

                        <?php
                            global $paged;
                            global $wp_query;
                        ?>

                        <div class="items items-news <?php if( $paged != 0 ){ echo 'paged'; } ?>">
							<?php

							if ( $_GET['year'] != null ) {
								$year  = $_GET['year'];
								$month = $_GET['month'];

								echo load_posts( $year, $month, 'news' );

							} else {

								$temp     = $wp_query;
								$wp_query = null;
								$wp_query = new WP_Query();
								$i        = 1;
								$wp_query->query( 'posts_per_page=8&post_type=news' . '&paged=' . $paged );

								while ( $wp_query->have_posts() ) : $wp_query->the_post();

									if ( $i <= 4 && $paged == 0 ) {
										$words = 40;
										$class = 'style-1';
									} else {
										$words = 15;
										$class = 'style-2';
									}
									?>

                                    <a href="<?= get_permalink( $post->ID ); ?>"
                                       class="item animate fade-bottom <?= $class; ?>" data-delay="100">
                                        <div class="holder">
                                            <div class="image"
                                                 style="background-image: url('<?= get_the_post_thumbnail_url( $item->ID ); ?>');">
                                                <div class="holder">
													<?php if ( $class == 'style-1' ) { ?>
                                                        <span class="meta"><?= get_the_time( 'd בF Y', $post->ID ); ?></span>
                                                        <h3><?= get_the_title( $item->ID ); ?></h3>
													<?php } ?>
                                                </div>
                                            </div>
                                            <div class="text">
												<?php if ( $class == 'style-2' ) { ?>
                                                    <span class="meta"><?= get_the_time( 'd בF Y', $post->ID ); ?></span>
                                                    <h3><?= get_the_title( $post->ID ); ?></h3>
												<?php } ?>
												<?=$post->post_excerpt; ?>
                                            </div>
                                        </div>
                                    </a>

									<?php $i ++; endwhile;
							}
							?>
                        </div>

                        <div class="pagination">
							<?php wp_paginate('nextpage=<i class="fa fa-chevron-left" aria-hidden="true"></i>&previouspage=<i class="fa fa-chevron-right" aria-hidden="true"></i>'); ?>
                        </div>

                        <?php
                            $wp_query = null;
                            $wp_query = $temp;
                            wp_reset_query();
						?>

                    </div>
                </div>
            </div>
        </section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
