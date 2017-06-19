<?php

get_header();

if( $_GET['post_type'] == 'news' ){
    $banner_img = get_field('news_archive_banner_image', 'option');
    $banner_title = get_field('news_archive_banner_title', 'option');
    $type = 'news';
}elseif( $_GET['post_type'] == 'events' ){
    $banner_img = get_field('events_archive_banner_image', 'option');
    $banner_title = get_field('events_archive_banner_title', 'option');
    $type = 'events';
}elseif( $_GET['post_type'] == 'press-releases' ){
    $banner_img = get_field('prs_archive_banner_image', 'option');
    $banner_title = get_field('prs_archive_banner_title', 'option');
    $type = 'press-releases';
}elseif( $_GET['post_type'] == '' ){
    $banner_img = get_field('blog_archive_banner_image', 'option');
    $banner_title = get_field('blog_archive_banner_title', 'option');
    $type = 'post';
}

?>

    <?php if (have_posts()) :  ?>

        <section id="section-title-strip" style="background-image: url('<?=$banner_img; ?>');">
            <div class="shell">
                <h1><?=$banner_title; ?></h1>
            </div>
        </section>


        <section id="section-items-feed">
            <div class="shell">

                <?php if( get_field( $type.'_show_hide_archives', 'option') == 'show' ){ ?>

                    <div class="section-header archive">
                        <ul>
                            <?php wp_get_archives(array('type'=>'yearly', 'post_type'=>$type )); ?>
                        </ul>
                    </div>

                <?php } ?>

                <div class="section-body">
                    <?php
                    if( is_month() ) {
                        $args = array(
                            'posts_per_page'        => -1,
                            'post_type'        => $_GET['post_type'],
                            'post_status'      => 'publish',
                            'year'     => get_the_date('Y'),
                            'monthnum'     => get_the_date('m')
                        );
                    }else{
                        $args = array(
                            'posts_per_page'        => -1,
                            'post_type'        => $_GET['post_type'],
                            'post_status'      => 'publish',
                            'year'     => get_the_date('Y'),
                        );
                    }

                    $posts_array = query_posts( $args );
                    foreach ($posts_array as $post ){ setup_postdata($post);
                        ?>
                        <div class="item">
                            <div class="holder">

                                <div class="content">
                                    <?php
                                        if( get_sub_field('date', $post->ID) != null ) {
                                            $date = get_sub_field('date', $post->ID);
                                        }else{
                                            $date = get_the_time('M d, Y', $post->ID);
                                        }
                                    ?>
                                    <span class="meta"><?=$date; ?></span>
                                    <h3><?=get_the_title($post->ID); ?></h3>
                                    <div class="text"><?=wp_trim_words(get_the_content($post->ID), 35,'...'); ?></div>

                                    <?php
                                        if( get_field('open_in_new_tab', $post->ID) == 1 ){
                                            $target = 'target="_blank"';
                                        }else{
                                            $target = '';
                                        }

                                        if( get_field('external_link', $post->ID) != null ){
                                            $url = get_field('external_link', $post->ID);
                                        }else{
                                            $url = get_the_permalink();
                                        }
                                    ?>
                                    <a <?=$target; ?> href="<?=$url; ?>" class="btn btn-transparent-red">Read More</a>
                                </div>

                                <?php if( has_post_thumbnail() ){ ?>
                                    <div class="image">
                                        <img src="<?php the_post_thumbnail_url( 'large' ); ?>" />
                                    </div>
                                <?php } ?>

                                <span class="custom-border"></span>
                            </div>
                        </div>
                    <?php } wp_reset_query(); ?>
                </div>

            </div>
        </section>

    <?php endif; ?>

<?php get_footer(); ?>
