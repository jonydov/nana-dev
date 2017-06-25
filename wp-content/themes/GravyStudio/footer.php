<footer>
    <div class="shell">
        <ul class="socials">
			<?php if ( get_field( 'youtube', 'option' ) != null ) { ?>
                <li>
                    <a href="<?= get_field( 'youtube', 'option' ); ?>">
                        <i class="zmdi zmdi-youtube"></i>
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
			<?php if ( get_field( 'facebook', 'option' ) != null ) { ?>
                <li>
                    <a href="<?= get_field( 'facebook', 'option' ); ?>">
                        <i class="zmdi zmdi-facebook-box"></i>
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
        </ul>

        <?php echo do_shortcode( get_field('form_shortcode', 'option') ); ?>

        <?php if( get_field('footer_text', 'option') != null ){ ?>
            <div class="footer-text">
                <?php echo get_field('footer_text', 'option'); ?>
            </div>
        <?php } ?>

    </div>
</footer>
</body>
</html>

<?php echo get_field( 'footer_scripts' ); ?>


<?php wp_footer(); ?>


</body>
</html>