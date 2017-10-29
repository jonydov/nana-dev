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
                        <?php if ( get_field( 'youtube', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'youtube', 'option' ); ?>">
                                    <i class="zmdi zmdi-youtube-play"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ( get_field( 'apple', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'apple', 'option' ); ?>">
                                    <i class="zmdi zmdi-apple"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ( get_field( 'instagram', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'instagram', 'option' ); ?>">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ( get_field( 'twitter', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'twitter', 'option' ); ?>">
                                    <i class="zmdi zmdi-twitter"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ( get_field( 'facebook', 'option' ) != null ) { ?>
                            <li>
                                <a href="<?= get_field( 'facebook', 'option' ); ?>">
                                    <i class="zmdi zmdi-facebook-box"></i>
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