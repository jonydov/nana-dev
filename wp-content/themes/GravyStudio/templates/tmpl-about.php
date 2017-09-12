<?php
/*
    Template Name: אודות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>


    <section class="section-about">

			<div class="shell">

                <div class="shellR">

                  <div class="section-title">

                    <?php if( get_sub_field('title') != null ){ ?>
                        <h2><?php the_sub_field('title'); ?></h2>
                    <?php } ?>
                </div>

                  <div class="section-body">

                    <?php if( get_sub_field('about_text') != null ){ ?>
                        <div class="text-about">
                            <span><?php the_sub_field('about_text'); ?></span>
                        </div>
                    <?php } ?>
                  </div>

                </div>

                <div class="shellL">

                    <div class="contact-form">

                    <?php if( get_sub_field('contact_form') != null ){ ?>
                        <div class="contact-form">
                            <span><?php the_sub_field('contact_form'); ?></span>
                        </div>
                    <?php } ?>

                    </div>

                </div>
			</div>

		</section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>
