	</div>
<footer>
	<div class="container-topfooter">
	<section class="topfooter">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</section>
	</div>
	<div class="container-footer">
		<section class="bottomfooter">
			<div class="copyright">
				<?php echo devise_copyright(); ?><?php echo get_theme_mod( 'copyright_details' ); ?>
			</div>
			<div class="footer-nav">
				<?php
				if ( function_exists( 'wp_nav_menu' ) )
					wp_nav_menu( 
						array( 
						'theme_location' => 'custom-menu',
						'fallback_cb'=> 'custom_menu',
						'container' => 'ul',
						'menu_id' => 'main-headernav',
						'menu_class' => 'footernav') 
					);
				else custom_menu();
				?>
			</div>
		</section>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>