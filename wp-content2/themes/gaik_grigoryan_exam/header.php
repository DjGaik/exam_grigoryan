<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bloginfo('name'); ?> <?php wp_title('&raquo;', true, left); ?></title>
<?php wp_head(); ?>
</head>
<body>
	<header>
			<h1><a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_theme_mod( 'header_logo' ); ?>" alt="logo"></a></h1>
			<nav>
				<?php
				if ( function_exists( 'wp_nav_menu' ) )
					wp_nav_menu( 
						array( 
						'theme_location' => 'custom-menu',
						'fallback_cb'=> 'custom_menu',
						'container' => 'ul',
						'menu_id' => 'main-headernav',
						'menu_class' => 'headernav') 
					);
				else custom_menu();
				?>
			</nav>
	</header>
	<div class="page-title">
		<h3><?php wp_title(' ', true, left); ?></h3>
	</div>
	
	<div class="container">