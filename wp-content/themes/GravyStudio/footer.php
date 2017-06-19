
    <footer>
        <div class="footer-top">
            <div class="shell cols">
                <div class="col col-three">
                    <div class="holder">
                        <?php if( get_field('right_col_title', 'option') ){ ?>
                            <div class="title"><?php echo get_field('right_col_title', 'option'); ?></div>
                        <?php } ?>
                        <div class="links">
                            <?php if( have_rows('footer_links', 'option') ):
                                while ( have_rows('footer_links', 'option') ) : the_row(); ?>
                                    <a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('link_text'); ?></a>
                                <?php endwhile;
                            endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col col-two">
                    <div class="holder">
                        <?php if( get_field('left_col_title', 'option') ){ ?>
                            <div class="title"><?php echo get_field('left_col_title', 'option'); ?></div>
                        <?php } ?>
                        <div class="links">
                            <?php if( get_field('phone', 'option') ){ ?>
                                <a class="link phone" href="tel:<?php the_field('phone', 'option'); ?>">
                                    <i class="zmdi zmdi-phone"></i>
                                    <?php the_field('phone', 'option'); ?>
                                </a>
                            <?php } ?>

                            <?php if( get_field('email', 'option') ){ ?>
                                <a class="link email" href="mailto:<?php the_field('email', 'option'); ?>">
                                    <i class="zmdi zmdi-email"></i>
                                    <?php the_field('email', 'option'); ?>
                                </a>
                            <?php } ?>

                            <?php if( get_field('facebook_link', 'option') ){ ?>
                                <a target="_blank" class="link facebook" href="<?php the_field('facebook_link', 'option'); ?>">
                                    <i class="zmdi zmdi-facebook"></i>
                                    <?php the_field('facebook_link_text','option'); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col col-one">
                    <a href="<?php bloginfo('url'); ?>">
                        <?php $img = get_field('logo', 'option'); ?>
                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" title="<?php echo $img['title']; ?>" />
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="shell">
                <div class="copyright">
                    <?php the_field('copyrights', 'option'); ?>
                </div>
                <div class="socials">
                    <ul>
	                    <?php if( get_field('facebook', 'option') != null ){ ?>
                            <li>
                                <a class="ico ico-fb" href="<?=get_field('facebook', 'option'); ?>"></a>
                            </li>
	                    <?php } ?>

                        <?php if( get_field('twitter', 'option') != null ){ ?>
                            <li>
                                <a class="ico ico-li" href="<?=get_field('twitter', 'option'); ?>"></a>
                            </li>
	                    <?php } ?>

                        <?php if( get_field('youtube', 'option') != null ){ ?>
                            <li>
                                <a class="ico ico-yt" href="<?=get_field('youtube', 'option'); ?>"></a>
                            </li>
	                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php echo get_field('footer_scripts'); ?>


<?php wp_footer(); ?>


</body>
</html>