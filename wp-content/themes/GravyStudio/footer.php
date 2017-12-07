<footer>
    <div class="shell">

        <div class="holder">

            <div class="col col-right">
                <a class="logo" href="<?php bloginfo('url'); ?>">
                    <?php
                      $logo = get_field('logo', 'option');
                    ?>
                    <img src="<?php echo $logo; ?>" />
                </a>

                <div class ="holder-col holder-text">

                    <?php if( get_field('footer_text', 'option') != null ){ ?>
                        <div class="footer-text">
                            <?php echo get_field('footer_text', 'option'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class ="holder-col holder-social">
                    <ul class="socials">
	                    <?php if( get_field('youtube', 'option') != null ){ ?>
                            <li>
                                <a href="<?=get_field('youtube', 'option'); ?>">
                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if ( get_field( 'spotify', 'option' ) != null ) { ?>
                            <li>
                                <a target="_blank" href="<?= get_field( 'spotify', 'option' ); ?>" class="ico-social">
                                    <i class="fa fa-spotify" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if ( get_field( 'apple', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'apple', 'option' ); ?>">
                                    <i class="fa fa-apple" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if( get_field('instagram', 'option') != null ){ ?>
                            <li>
                                <a href="<?=get_field('instagram', 'option'); ?>">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if( get_field('twitter', 'option') != null ){ ?>
                            <li>
                                <a href="<?=get_field('twitter', 'option'); ?>">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>
	                    <?php if( get_field('facebook', 'option') != null ){ ?>
                            <li>
                                <a href="<?=get_field('facebook', 'option'); ?>">
                                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                </a>
                            </li>
	                    <?php } ?>

                    </ul>
                </div>
            </div>


            <div class="col col-left">

            <?php if( get_field('form_shortcode', 'option') != null ){ ?>

                <div class="newsletter-form">
                    <span>
                         <?php echo do_shortcode( get_field('form_shortcode', 'option') ); ?>
                    </span>
                </div>
            <?php } ?>
            </div>


        </div>
    </div>
</footer>
</body>
</html>

<?php echo get_field( 'footer_scripts' ); ?>


<?php wp_footer(); ?>


</body>
</html>