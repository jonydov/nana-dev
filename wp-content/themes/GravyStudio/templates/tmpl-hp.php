<?php
/*
    Template Name: Homepage
*/

get_header();
?>

<?php if ( have_rows( 'content_sections' ) ): while ( have_rows( 'content_sections' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'banner' ) { ?>

        <section class="section-banner">
            <div class="item" <?php if( get_sub_field( 'image') != null ){ $img = get_sub_field( 'image'); ?>style="background-image: url('<?=$img['url']; ?> ?>');"<?php } ?>>
                <div class="shell">
                    <div class="holder">
						<?php if ( get_sub_field( 'text' ) != null ) { ?>
                            <h1 class="animate fade-right" data-delay="100"><?= the_sub_field( 'text' ); ?></h1>
						<?php } ?>
                    </div>
                </div>
            </div>
        </section>

	<?php } elseif ( get_row_layout() == 'highlighted_text' ) { ?>

        <section class="section-highlighted-text" <?php if( get_sub_field( 'bg_image') != null ){ ?>style="background-image: url('<?=get_sub_field( 'bg_image'); ?> ');"<?php } ?>>

            <div class="shell">
                <div class="section-body animate fade-bottom" data-delay="100">
                    <?php the_sub_field('text'); ?>
                </div>
            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'numbers_section' ) { ?>

        <section class="section-numbers" <?php if( get_sub_field( 'bg_image') != null ){ ?>style="background-image: url('<?=get_sub_field( 'bg_image'); ?> ');"<?php } ?>>

            <div class="shell">

                <div class="section-header">
                    <h2><?=get_sub_field('title'); ?></h2>
                </div>

	            <?php if ( have_rows( 'items' ) ): ?>
                    <div class="section-body">
                        <?php while ( have_rows( 'items' ) ) : the_row(); ?>
                            <div class="item animate fade-bottom" data-delay="50">
                                <div class="holder">
	                                <?php the_sub_field('text'); ?>
                                    <h4><?php the_sub_field('title'); ?></h4>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
	            <?php endif; ?>
            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'logos_slider' ) { ?>

        <section class="section-logos-slider white-section">

            <div class="shell">

                <?php if ( have_rows( 'add_items' ) ): ?>
                    <div class="logos-slider">
                        <?php while ( have_rows( 'add_items' ) ) : the_row(); ?>
                            <div class="item">
                                <div class="holder">
                                    <div class="image">
                                        <img src="<?php the_sub_field('logo'); ?>" />
                                    </div>
                                    <span class="border"></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ( have_rows( 'add_items' ) ): ?>
                    <div class="texts-slider">
                        <?php while ( have_rows( 'add_items' ) ) : the_row(); ?>
                            <div class="item">
                                <div class="holder">
                                    <div class="text">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'form_section' ) { ?>

        <section class="section-form white-section">

            <div class="shell">

                <div class="col col-text animate fade-right" data-delay="100">
                    <div class="holder">

                        <?php if( get_sub_field('image') != null ){ ?>
                            <div class="image" style="background-image: url('<?=get_sub_field('image'); ?>');"></div>
                        <?php } ?>

                        <div class="text">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <?php the_sub_field('text'); ?></>
                        </div>

                    </div>
                </div>

                <div class="col form-holder animate fade-left" data-delay="100">
                    <div class="holder">
                        <?php echo do_shortcode( get_sub_field('form_shortcode') ); ?>
                    </div>
                </div>

            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'image_section' ) { ?>

        <section class="section-image" style="background-color: <?php the_sub_field('bg_color'); ?>">

            <div class="shell">

				<a href="<?php the_sub_field('link'); ?>" class="img-holder animate fade-bottom" data-delay="100">
                    <div class="holder">
	                    <?php if( get_sub_field('logo') != null ){ ?>
                            <img class="img-logo" src="<?=get_sub_field('logo'); ?>" />
	                    <?php } ?>
                        <div class="img" style="background-image: url('<?=get_sub_field('image'); ?>');"></div>
						<div class="text">
							<h3 class="animate fade-right" data-delay="150"><?php the_sub_field('title'); ?></h3>
							<span class="animate fade-right" data-delay="170"><?php the_sub_field('text'); ?></span>
                        </div>
                    </div>
                </a>

            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'text_strip' ) { ?>

        <section class="section-text-strip skrollable"
		         <?php if ( get_sub_field( 'bg_image' ) != null ){ ?>style="background-image: url('<?= the_sub_field( 'bg_image' ); ?>');"<?php } ?>>

            <div class="shell">
				<?php if ( get_sub_field( 'title' ) != null ) { ?>
                    <div class="section-header">
                        <h2><?= the_sub_field( 'title' ); ?></h2>
                    </div>
				<?php } ?>
                <div class="section-body">
                    <div class="holder">
						<?php if ( get_sub_field( 'text' ) != null ) { ?>
                            <div class="text">
								<?= get_sub_field( 'text' ); ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'features_strip' ) { ?>

        <section class="section-features-strip"
		         <?php if ( get_sub_field( 'bg_image' ) != null ){ ?>style="background-image: url('<?= the_sub_field( 'bg_image' ); ?>');"<?php } ?>>
            <div class="shell">
				<?php if ( get_sub_field( 'title' ) != null ) { ?>
                    <div class="section-header">
                        <h2><?= the_sub_field( 'title' ); ?></h2>
                    </div>
				<?php } ?>
                <div class="section-body animate fade-bottom" data-delay="100">
					<?php if ( have_rows( 'features' ) ): ?>
						<?php while ( have_rows( 'features' ) ) : the_row(); ?>

                            <div class="col">
                                <div class="holder">
									<?php if ( get_sub_field( 'title' ) != null ) { ?>
                                        <h3>
											<?php if ( get_sub_field( 'icon' ) != null ) { ?>
                                                <img class="icon" src="<?= get_sub_field( 'icon' ); ?>"/>
											<?php } ?>
											<?= the_sub_field( 'title' ); ?>
                                        </h3>
									<?php } ?>

									<?php if ( get_sub_field( 'text' ) != null ) { ?>
                                        <div class="text">
											<?= get_sub_field( 'text' ); ?>
                                        </div>
									<?php } ?>
                                </div>
                            </div>

						<?php endwhile; ?>
					<?php endif; ?>
                </div>
            </div>

        </section>

	<?php } elseif ( get_row_layout() == 'contact_strip' ) { ?>

        <section class="section-contact-strip">

            <div class="shell">
                <div class="section-body">
                    <div class="holder animate fade-bottom" data-delay="100">
						<?php if ( get_sub_field( 'map_image' ) != null ) {
							$img = get_sub_field( 'map_image' ); ?>
                            <img src="<?= $img; ?>"/>
						<?php } ?>
                    </div>
                </div>
            </div>
            <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                <polygon points="100 0 100 10 0 10"/>
            </svg>
        </section>

	<?php } elseif ( get_row_layout() == 'info_strip' ) { ?>

        <section class="section-info-strip">
            <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
                <polygon points="100 0 100 10 0 10"/>
            </svg>

            <div class="shell">
				<?php if ( get_sub_field( 'title' ) != null ) { ?>
                    <div class="section-header">
                        <h2><?= the_sub_field( 'title' ); ?></h2>

						<?php if ( get_sub_field( 'subtitle' ) != null ) { ?>
                            <span class="subtitle"><?= the_sub_field( 'subtitle' ); ?></span>
						<?php } ?>
                    </div>
				<?php } ?>
                <div class="section-body">
					<?php if ( have_rows( 'columns' ) ): ?>
						<?php while ( have_rows( 'columns' ) ) : the_row(); ?>

                            <div class="col">
                                <div class="holder">
									<?php if ( get_sub_field( 'title' ) != null ) { ?>
                                        <h3>
											<?php if ( get_sub_field( 'icon' ) != null ) { ?>
                                                <img class="icon" src="<?= get_sub_field( 'icon' ); ?>"/>
											<?php } ?>
											<?= the_sub_field( 'title' ); ?>
                                        </h3>
									<?php } ?>

									<?php if ( get_sub_field( 'text' ) != null ) { ?>
                                        <div class="text">
											<?= get_sub_field( 'text' ); ?>
                                        </div>
									<?php } ?>
                                </div>
                            </div>

						<?php endwhile; ?>
					<?php endif; ?>
                </div>
            </div>

        </section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
