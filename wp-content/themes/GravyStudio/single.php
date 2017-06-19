<?php
get_header();

$banner_img = get_field('blog_archive_banner_image', 'option');
$banner_title = get_field('blog_archive_banner_title', 'option');
$type = 'post';

?>

<section id="section-title-strip" style="background-image: url('<?=$banner_img; ?>');">
    <div class="shell">
        <h1><?=$banner_title; ?></h1>
    </div>
</section>

<section id="section-single-content" class="section-sidebar">

    <div class="shell cf">

        <div class="section-body">
            <span class="meta"><?=get_the_time('M d, Y'); ?></span>
            <h3><?=get_the_title(); ?></h3>
            <span class="author">By: <?=get_the_author(); ?></span>
            <div class="text"><?php the_content(); ?></div>
        </div>

        <div class="sidebar">

            <?php if ( is_active_sidebar( 'blog-posts-sidebar' ) ) : ?>
                <div class="holder">
                    <?php dynamic_sidebar( 'blog-posts-sidebar' ); ?>

                    <?php the_field('sidebar'); ?>

                </div>
            <?php endif; ?>

            <?php if ( get_field('sidebar') != null ) : ?>
                <div class="holder">
                    <?php dynamic_sidebar( 'blog-posts-sidebar' ); ?>

                    <?php the_field('sidebar'); ?>

                </div>
            <?php endif; ?>
        </div>

    </div>

    <div class="shell cf">
        <?php if( get_field( $type.'_show_hide_archives', 'option') == 'show' ){ ?>

            <div class="section-header archive">
                <ul>
                    <?php wp_get_archives(array('type'=>'yearly', 'post_type'=>$type )); ?>
                </ul>
            </div>

        <?php } ?>
    </div>

</section>

<?php get_footer(); ?>
