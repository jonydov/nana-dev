<?php
/*
    Template Name: עמוד הבית
*/

get_header();

?>

<?php if ( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>

	<?php if ( get_row_layout() == 'main_banner' ) { ?>

        <section class="section-banner">

	        <?php if( get_sub_field('hide_artists_box') == false ){ ?>
                <div class="shell">
                    <div class="artists animate fade-top" data-delay="100">
                        <div class="artists-slider">
                            <?php
                                $args = array(
                                    'post_type' => 'artists',
                                    'posts_per_page' => -1,
                                );

                                $posts = get_posts($args);

                                $i = 1;
                                $c = count($posts);
                                $m = 5;

                                foreach ($posts as $post){
                                    if( $i == 1 ){ echo '<div class="col">'; }
                                    if( $i % 5 == 0 ){ echo '</div><div class="col">'; }
	                                echo '<a href="'.get_permalink($post->ID).'"><span>'.$post->post_title.'</span></a>';
	                                if( $i == $c ){ echo '</div>'; }
                                    $i++;
                                } wp_reset_postdata();
                            ?>
                        </div>
                        <?php if( get_sub_field('link_text') != null ){ ?>
                            <a class="cta" href="<?=get_sub_field('link_url'); ?>"><?=get_sub_field('link_text'); ?></a>
                        <?php } ?>
                    </div>
                </div>
	        <?php } ?>

            <div class="slider-texts-holder animate fade-right" data-delay="100">
	            <?php
	            if( have_rows('slides') ):
		            while ( have_rows('slides') ) : the_row();
			            ?>

                        <div class="item">
                            <div class="shell">
                                <div class="holder">
						            <?php if( get_sub_field('title') != null ){ ?>
                                        <h2><?php the_sub_field('title'); ?></h2>
						            <?php } ?>

						            <?php if( get_sub_field('subtitle') != null ){ ?>
                                        <h3><?php the_sub_field('subtitle'); ?></h3>
						            <?php } ?>

						            <?php if( get_sub_field('link_text') != null ){ ?>
                                        <a class="read-more" target="<?php the_sub_field('open_in'); ?>" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?></a>
						            <?php } ?>
                                </div>
                            </div>
                        </div>

			            <?php
		            endwhile;
	            endif;
	            ?>
            </div>

            <div class="slider-holder">

		        <?php
                    if( have_rows('slides') ):
                        while ( have_rows('slides') ) : the_row();
                            ?>

                            <div class="item" style="background-image: url('<?php the_sub_field('image'); ?>"></div>

                            <?php
                        endwhile;
                    endif;
		        ?>
            </div>
        </section>

    <?php }elseif ( get_row_layout() == 'albums' ) { ?>

        <section class="section-albums">

            <div class="shell animate fade-bottom" data-delay="100">

				<?php if( get_sub_field('title') != null ){; ?>
                    <div class="section-title">
                        <h2><?php the_sub_field('title'); ?></h2>
                    </div>
				<?php }; ?>

				<?php if( have_rows('add_items') ): ?>
                    <div class="section-body">

						<?php while ( have_rows('add_items') ) : the_row(); ?>

                            <?php
                                $album = get_sub_field('select_item');
                                $artist = get_field('assigned_artist', $album->ID);
                                $img = get_the_post_thumbnail_url($album->ID);
                            ?>

                            <a href="<?=get_permalink($album->ID); ?>" class="item">
                                <div class="holder">
                                    <div class="image" <?php if( $img != null ){ echo 'style="background-image: url('.$img.');"'; } ?>></div>
                                    <div class="text">
                                        <span class="name-artist"><?=$artist->post_title; ?></span>
                                        <span class="name-album"><?=$album->post_title; ?></span>
	                                    <?php
                                            $date = get_field('publish_date', $album->ID);
	                                        $date = str_replace('/', '<span>', $date);
	                                        $date = str_replace('!', '</span>', $date);
	                                    ?>
                                        <span class="date"><?=$date; ?></span>
                                        <span class="cta">לאלבום</span>
                                    </div>
                                </div>
                            </a>

                        <?php endwhile; ?>

                    </div>
				<?php endif; ?>

            </div>

        </section>

	<?php }elseif ( get_row_layout() == 'shows_slider' ) { ?>

        <section class="section-shows-slider">

            <div class="shell animate fade-bottom" data-delay="100">

                <div class="section-header">
	                <?php if( get_sub_field('title') != null ){ ?>
                        <h2><?=get_sub_field('title'); ?></h2>
	                <?php } ?>

	                <?php if( get_sub_field('link_text') != null ){ ?>
                        <a class="cta" href="<?=get_sub_field('link_url'); ?>"><?=get_sub_field('link_text'); ?></a>
	                <?php } ?>
                </div>

                <div class="shows-slider-holder">

                    <?php
                        $args = array(
                            'post_type' => 'shows',
                            'posts_per_page' => 10,
                            'orderby' => 'date',
                            'order' => 'ASC',
                        );

                        $posts = get_posts($args);

                        foreach ($posts as $post){
                            $artist = get_field('assigned_artist', $post->ID);
	                        $venue = get_field('venue', $post->ID);
                            $img = get_the_post_thumbnail_url($post->ID);
                        ?>

                            <a href="<?=get_permalink($post->ID); ?>" class="item">
                                <div class="holder">
                                    <div class="image" <?php if( $img != null ){ echo 'style="background-image: url('.$img.');"'; } ?>></div>
                                    <div class="text">
                                        <span class="name-artist"><?=$artist->post_title; ?></span>
                                        <?php
                                        $date = get_field('date', $post->ID);
                                        $date = str_replace('/', '<span>', $date);
                                        $date = str_replace('!', '</span>', $date);
                                        ?>
                                        <span class="venue"><?=$venue; ?></span>
                                        <span class="date"><?=$date; ?></span>
                                        <span class="cta">לכרטיסים</span>
                                    </div>
                                </div>
                            </a>

                    <?php } ?>
                </div>
            </div>

        </section>

	<?php }elseif ( get_row_layout() == 'items_feed_2cols' ) { ?>

        <section class="section-feed-2cols">

            <div class="shell">
                <?php $type = get_sub_field('col_right_post_type'); ?>
				<div class="col <?=$type; ?> animate fade-right" data-delay="100">
                    <div class="holder">

                        <?php if( get_sub_field('col_right_title') != null ){ ?>
                            <h2><?=get_sub_field('col_right_title'); ?></h2>
                        <?php } ?>

                        <?php if( get_sub_field('col_right_link_text') != null ){ ?>
                            <a class="cta" href="<?=get_sub_field('col_right_link_url'); ?>"><?=get_sub_field('col_right_link_text'); ?></a>
                        <?php } ?>

                        <div class="items">
                            <?php
                                $args = array(
                                    'post_type' => $type,
                                    'posts_per_page' => 3,
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                );

                                $posts = get_posts($args);


                                foreach ($posts as $post){
                            ?>

	                                <?php if( $type == 'video-clips'){ ?>
                                        <a href="<?=get_field('youtube', $post->ID); ?>" class="item popup-yt">
                                            <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                                <div class="holder"></div>
                                                <div class="text">
                                                    <span class="vid-name"><?php the_title(); ?></span>
                                                    <span class="artist-name"><?php the_field('artist_name', $post->ID); ?></span>
                                                </div>
                                            </div>
                                        </a>
	                                <?php }elseif( $type == 'news'){ ?>
                                        <a href="<?=get_permalink($post->ID); ?>" class="item">
                                            <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                                <div class="holder"></div>
                                            </div>
                                            <div class="content">
                                                <span class="date"><?=get_the_time('d <b>בF</b>, Y'); ?></span>
                                                <h3><?=$post->post_title; ?></h3>
                                                <div class="text"><?php echo wp_trim_words($post->post_content, 12, '...'); ?></div>
                                            </div>
                                        </a>
	                                <?php } ?>

                            <?php } wp_reset_postdata(); ?>
                        </div>

                    </div>
                </div>

	            <?php $type = get_sub_field('col_left_post_type'); ?>
                <div class="col <?=$type; ?> animate fade-left" data-delay="100">
                    <div class="holder">

                        <?php if( get_sub_field('col_left_title') != null ){ ?>
                            <h2><?=get_sub_field('col_left_title'); ?></h2>
                        <?php } ?>

                        <?php if( get_sub_field('col_left_link_text') != null ){ ?>
                            <a class="cta" href="<?=get_sub_field('col_left_link_url'); ?>"><?=get_sub_field('col_left_link_text'); ?></a>
                        <?php } ?>

                        <div class="items">
                            <?php
                                $args = array(
                                    'post_type' => $type,
                                    'posts_per_page' => 3,
                                    'orderby' => 'date',
                                    'order' => 'ASC',
                                );

                                $posts = get_posts($args);


                                foreach ($posts as $post){
                            ?>

                                <?php if( $type == 'video-clips'){ ?>
                                    <a href="<?=get_field('youtube', $post->ID); ?>" class="item popup-yt">
                                        <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                            <div class="holder"></div>
                                            <div class="text">
                                                <span class="vid-name"><?php the_title(); ?></span>
                                                <span class="artist-name"><?php the_field('artist_name', $post->ID); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php }elseif( $type == 'news'){ ?>
                                    <a href="<?=get_permalink(); ?>" class="item">
                                        <div class="image" style="background-image: url('<?=get_the_post_thumbnail_url($post->ID); ?>');">
                                            <div class="holder"></div>
                                        </div>
                                        <div class="content">
                                            <span class="date"><?=get_the_time('d ב M, Y'); ?></span>
                                            <h3><?=$post->post_title; ?></h3>
                                            <div class="text"><?php echo wp_trim_words($post->post_content, 12, '...'); ?></div>
                                        </div>
                                    </a>
                                <?php } ?>

                            <?php } wp_reset_postdata(); ?>
                        </div>

                    </div>
                </div>

            </div>

        </section>

	<?php } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
