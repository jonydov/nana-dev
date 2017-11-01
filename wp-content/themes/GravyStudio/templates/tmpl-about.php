<?php
/*
    Template Name: אודות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>


    <section class="section-about">

        <div class="shell">

            <div class="col col-right">
                <div class="holder">
                    <div class="section-title">

						<?php if ( get_sub_field( 'title' ) != null ) { ?>
                            <h2><?php the_sub_field( 'title' ); ?></h2>
						<?php } ?>
                    </div>

                    <div class="section-body">

						<?php if ( get_sub_field( 'about_text' ) != null ) { ?>
                            <div class="text-about">
                                <?php the_sub_field( 'about_text' ); ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>

            <div class="col col-left">

                <div class="holder">

					<?php if ( get_sub_field( 'newsletter_form' ) != null ) { ?>
                        <div class="newsletter-form">
                                <span>
                                    <?php echo do_shortcode( get_sub_field( 'newsletter_form', 'option' ) ); ?>
                                </span>
                        </div>
					<?php } ?>

					<?php if ( get_sub_field( 'contact_form' ) != null ) { ?>
                        <div class="contact-form">
                            <span>
                                <?php echo do_shortcode( get_sub_field( 'contact_form', 'option' ) ); ?>
                            </span>
                        </div>
					<?php } ?>

                    <div class="section-footer">

                        <ul class="socials">
							<?php if ( get_field( 'youtube', 'option' ) != null ) { ?>
                                <li>
                                    <a href="<?= get_field( 'youtube', 'option' ); ?>">
                                        <i class="ico ico-yt"></i>
                                    </a>
                                </li>
							<?php } ?>
							<?php if ( get_field( 'apple', 'option' ) != null ) { ?>
                                <li>
                                    <a href="<?= get_field( 'apple', 'option' ); ?>">
                                        <i class="ico ico-apple"></i>
                                    </a>
                                </li>
							<?php } ?>
							<?php if ( get_field( 'instagram', 'option' ) != null ) { ?>
                                <li>
                                    <a href="<?= get_field( 'instagram', 'option' ); ?>">
                                        <i class="ico ico-inst"></i>
                                    </a>
                                </li>
							<?php } ?>
							<?php if ( get_field( 'facebook', 'option' ) != null ) { ?>
                                <li>
                                    <a href="<?= get_field( 'facebook', 'option' ); ?>">
                                        <i class="ico ico-fb"></i>
                                    </a>
                                </li>
							<?php } ?>
							<?php if ( get_field( 'twitter', 'option' ) != null ) { ?>
                                <li>
                                    <a href="<?= get_field( 'twitter', 'option' ); ?>">
                                        <i class="ico ico-tw"></i>
                                    </a>
                                </li>
							<?php } ?>
                        </ul>

						<?php if ( get_sub_field( 'section_footer_text', 'option' ) != null ) { ?>
                            <div class="section-footer-text">

								<?php echo get_sub_field( 'section_footer_text', 'option' ); ?>
                            </div>
						<?php } ?>

                    </div>

                </div>
            </div>
        </div>

    </section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
