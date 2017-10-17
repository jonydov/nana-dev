<?php
/*
    Template Name: הפקות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'productions' ) { ?>

		<section class="section-productions" data-current-url="<?php the_permalink(); ?>">

			<div class="shell">
				<div class="section-header">
					<h1>הפקות מיוחדות</h1>
				</div>

				<div class="section-body">

                    <div class="productions-list">
						<?php dynamic_sidebar('productions-archives') ?>
                    </div>

					<div class="items items-productions">
						<?php echo load_productions(get_the_date('Y'), get_the_date('m')); ?>
					</div>
				</div>
			</div>

		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
