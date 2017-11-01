<?php
get_header();
?>

    <section class="section-title-strip">
        <div class="shell">
            <h1>תוצאות חיפוש עבור "<?php the_search_query(); ?> "</h1>
        </div>
    </section>

    <section class="section-simple-text">

        <div class="shell">

            <?php if ( have_posts() ) { while ( have_posts() ) : the_post();
                $type = $post->post_type;

                if( $type == 'news' ) {
                    $title = 'חדשות';
                }elseif( $type == 'productions' ) {
	                $title = 'הפקות מיוחדות';
                }elseif( $type == 'shows' ) {
	                $title = 'הופעות';
                }elseif( $type == 'artists' ) {
	                $title = 'אמנים';
                }elseif( $type == 'page' ) {
	                $title = 'עמודים';
                }

                if( get_the_excerpt($post->ID) != null ){
                    $excerpt = get_the_excerpt($post->ID);
                }else{
                    $excerpt = wp_trim_words($post->post_content, 50, '...');
                }
            ?>

                <a href="<?=get_permalink($post->ID); ?>" class="item">
                    <div class="title">
                        <h2><?php echo $post->post_title; ?></h2>
                        <span class="type"><?=$title;?></span>
                    </div>
                    <span class="excerpt"><?=$excerpt; ?></span>
                </a>

            <?php endwhile; } ?>

        </div>
    </section>

<?php get_footer(); ?>