<?php
/*
    Template Name: הפקות
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'productions' ) { ?>

		<section class="section-productions-archive" data-current-url="<?php the_permalink(); ?>">
		<div class="archive">
			<div class="shell">
				<div class="section-header">
					<h1>הפקות מיוחדות</h1>
				</div>

				<div class="section-body">

					<div class="archive-list">
						<?php dynamic_sidebar('productions-archives') ?>
					</div>

                    
					<div class="items items-productions">
						<?php echo load_posts(get_the_date('Y'), get_the_date('m'),'productions'); ?>

					</div>
				</div>
			</div>
		</div>
		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
