<?php
get_header();
?>

    <section id="section-title-strip">
        <div class="shell">
            <h1>Search Results For "<?php the_search_query(); ?> "</h1>
        </div>
    </section>

    <section id="section-simple-text">

        <div class="shell">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="text">
                        <?php if( get_post_type() == 'products' ) {
                            $text = get_field('content_blocks', get_the_ID())[0]['text'];
                            if ($text != null) {
                                    echo '<p>'.wp_trim_words($text, 25, '...').'</p>';
                                }
                            }
                        ?>

                        <?php the_excerpt(); ?>
                    </div>
                </div>

            <?php endwhile; endif; ?>

        </div>
    </section>

<?php get_footer(); ?>