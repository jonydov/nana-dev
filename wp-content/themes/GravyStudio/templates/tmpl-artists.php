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

                <div class="section-title">
                    <?php if( get_sub_field('title') != null ){ ?>
                        <h2><?php the_sub_field('title'); ?></h2>
                    <?php } ?>
                </div>

                <div class="section-body">

                    <div class="alphabet-scale">

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

                        $first_letter= mb_substr($post->post_title,0,1);

                        foreach ($posts_array as $post){

                            $index_letter = mb_substr($post->post_title,0,1);

                            if (strcasecmp($index_letter,$first_letter) !=0){
                                $first_letter=$index_letter; ?>
                                <div class="text"><span><?php echo $first_letter ?></span></div>

                            <?php } ; ?>
                        <?php } ?>

                    </div>

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


                    mb_internal_encoding("UTF-8");

                    $first_letter= mb_substr($post->post_title,0,1);

                    foreach ($posts_array as $post){
                        $img = get_the_post_thumbnail_url($post->ID);
                    ?>

                    <a href="<?=get_permalink($post->ID); ?>" class="item"

                        <?php $index_letter = mb_substr($post->post_title,0,1);

                        if (strcasecmp($index_letter,$first_letter) !=0){
                            $first_letter=$index_letter; ?>
                            name=index<?php echo $first_letter;  ?>
                        <?php } ?> >

                        <div class="image">
                            <div class="holder" <?php if( $img != null ){ echo 'style="background-image: url('.$img.');"'; } ?>>
                            </div>
                        </div>


                        <div class="text">
                            <span class="name-artist"><?=$post->post_title; ?></span>
                        </div>
                    </a>



                    <?php } ?>
                </div>
			</div>

		</section>

	<?php }?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
