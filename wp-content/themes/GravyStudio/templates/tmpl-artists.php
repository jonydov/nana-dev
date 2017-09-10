<?php
/*
    Template Name: אמנים
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'artists_grid' ) { ?>

		<section class="section-artists">

            <div class="shell">
	            <?php
                    $args = array(
                        'posts_per_page'   => -1,
                        'orderby'          => 'title',
                        'order'            => 'ASC',
                        'post_type'        => 'artists',
                        'post_status'      => 'publish',
                        'suppress_filters' => true
                    );

                    $posts_array = get_posts( $args );

                    foreach ($posts_array as $post){

	                    mb_internal_encoding("UTF-8");
	                    $title = get_the_title();
	                    $index_letter = mb_substr($string,0,1);
                ?>

                    <a class="item" name="<?php echo sanitize_title(get_the_title()); ?>" href="">
                        <?php the_title(); ?><br/>
                    </a>

                <?php } ?>
            </div>

		</section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
