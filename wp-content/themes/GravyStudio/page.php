<?php get_header(); ?>



<?php if( have_rows('content_blocks') ):
    while ( have_rows('content_blocks') ) : the_row(); ?>

        <?php if( get_row_layout() == 'intro' ){ ?>

            <section class="section-intro">
                <div class="shell cf">
                    <div class="section-body">

                        <a href="" class="logo-big">
                            <?php $img = get_sub_field('image'); ?>

                            <?php if( $img != null ){ ?>
                                <img src="<?=$img['url']; ?>" alt="<?=$img['url']; ?>" title="<?=$img['title']; ?>" />
                            <?php } ?>
                        </a>

                    </div>
                </div>
            </section>

        <?php }elseif( get_row_layout() == 'image_text' ){ ?>

            <?php $img = get_sub_field('image'); ?>

            <section id="<?=get_sub_field('section_id'); ?>" class="section-cols bg-left" <?php if( $img != null && get_sub_field('image_settings') == 'bg' ){ ?>style="background-image: url('<?=$img['url']; ?>')"<?php } ?>>
                <div class="bg-holder"></div>
                <div class="shell cf">
                    <div class="col col-text">
                        <div class="holder">

                            <?php if( get_sub_field('title') ){ ?>
                                <h2><?=get_sub_field('title'); ?></h2>
                            <?php } ?>

                            <?php if( get_sub_field('text') ){ ?>
                                <?=get_sub_field('text'); ?>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="col col-image">
                        <div class="holder">
                            <?php if( $img != null ){ ?>
                                <img src="<?=$img['url']; ?>" alt="<?=$img['url']; ?>" title="<?=$img['title']; ?>" />
                            <?php }elseif( gs_wp_is_mobile() ){ ?>
                                <img src="<?=$img['url']; ?>" alt="<?=$img['url']; ?>" title="<?=$img['title']; ?>" />
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php }elseif( get_row_layout() == 'text_image' ){ ?>

            <?php $img = get_sub_field('image'); ?>

            <section id="<?=get_sub_field('section_id'); ?>" class="section-cols bg-right" <?php if( $img != null && get_sub_field('image_settings') == 'bg' ){ ?>style="background-image: url('<?=$img['url']; ?>')"<?php } ?>>
                <div class="bg-holder rtl"></div>
                <div class="shell cf">
                    <div class="col col-image">
                        <div class="holder">

                            <?php if( $img != null ){ ?>
                                <img src="<?=$img['url']; ?>" alt="<?=$img['url']; ?>" title="<?=$img['title']; ?>" />
                            <?php }elseif( gs_wp_is_mobile() ){ ?>
                                <img src="<?=$img['url']; ?>" alt="<?=$img['url']; ?>" title="<?=$img['title']; ?>" />
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col col-text">
                        <div class="holder">
                            <?php if( get_sub_field('title') ){ ?>
                                <h2 class="large"><?=get_sub_field('title'); ?></h2>
                            <?php } ?>

                            <?php if( get_sub_field('text') ){ ?>
                                <?=get_sub_field('text'); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php }elseif( get_row_layout() == 'contact_section' ){ ?>

            <section id="<?=get_sub_field('section_id'); ?>" class="section-cols bg-right">
                <div class="bg-holder width-40 rtl"></div>
                <div class="shell cf">
                    <div class="col col-form width-60">

                        <div class="holder">

                            <?php echo do_shortcode( get_sub_field('form_shortcode') ); ?>

                            <div class="text">
                                <?=get_sub_field('text'); ?>
                            </div>
                        </div>

                    </div>
                    <div class="col col-text width-40">
                        <div class="holder">
                            <?php if( get_sub_field('title') ){ ?>
                                <h2 class="large"><?=get_sub_field('title'); ?></h2>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php }elseif( get_row_layout() == 'testimonials' ){ ?>

            <section id="<?=get_sub_field('section_id'); ?>" class="section-cols bg-right">
                <div class="bg-holder"></div>
                <div class="shell cf">
                    <div class="col col-text">
                        <div class="holder">
                            <?php if( get_sub_field('title') ){ ?>
                                <h2 class="large">המלצות</h2>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col col-text">
                        <div class="holder">
                            <div class="slider">
                                <?php if( have_rows('add_testimonials') ):
                                    while ( have_rows('add_testimonials') ) : the_row(); ?>
                                        <div class="slide">
                                            <div class="item">
                                                <?php if( get_sub_field('photo') ){ $img = get_sub_field('photo'); ?>
                                                    <div class="img-holder" style="background-image: url(<?=$img['url']; ?>);"></div>
                                                <?php } ?>
                                                <?php if( get_sub_field('name') ){ ?>
                                                    <h3><?=get_sub_field('name');?></h3>
                                                <?php } ?>
                                                <?php if( get_sub_field('title') ){ ?>
                                                    <h4><?=get_sub_field('title');?></h4>
                                                <?php } ?>
                                                <?php if( get_sub_field('text') ){ ?>
                                                    <div class="text">
                                                        <?=get_sub_field('text');?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } ?>

    <?php endwhile;
endif; ?>


<?php get_footer(); ?>