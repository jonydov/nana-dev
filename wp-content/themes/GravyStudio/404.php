<?php get_header(); ?>
	
	<section class="default-page-intro page404">
		<div class="section-body">
			<div class="shell">
				<div class="section-body-inner">
					<h3>welcome to</h3>
                    <h1>ROOM 404</h1>
                    <span>Just kidding, it's a 404 page.</span>
				</div><!-- /.section-body-inner -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	</section><!-- /.magazine-intro -->
	
	<section class="section second default-page-content page404">
		<div class="shell full-width">
			<div class="col">
				Get back on track:<br/>
                <ul>
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'depth' => 1,
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'items_wrap' => '<li>%3$s</li>',
                        'fallback_cb' => 'wp_page_menu',
                        'walker' => new wp_bootstrap_navwalker())
                    );
                ?>
                    </ul>
			</div>	
		</div>	
	</section>

<?php get_footer(); ?>
