<?php
get_header();
$id = get_queried_object()->ID;
?>

<section class="section-news-item">
    <div class="shell">

        <div class="section-top-bunner">

	        <?php if ( has_post_thumbnail() ) { $img = get_the_post_thumbnail_url(); ?>
                <div class="image" style="background-image: url('<?php echo $img; ?>');"></div>
            <?php } ?>

        </div>

        <div class="section-body">

            <div class="title"><h3><?= get_the_title(); ?></h3></div>
            <span class="date"><?= get_the_time( 'd בM, Y' ); ?></span>

            <div class="text">
                <div class="holder">
                    <div class="scrollbar" id="style-2">
                        <div class="force-overflow">
							<?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tag-list">
				<?php
				if ( get_the_tag_list() ) {
					echo get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
				}
				?>

            </div>


        </div>

    </div>
</section>


<section class="section-music">

    <div class="shell">

        <div class="holder">

            <div class="section-body">
				<?php the_field( 'music' ); ?>
            </div>

        </div>

    </div>

</section>


<?php get_footer(); ?>
