<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!-- HTML5 shiv -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/styles/reset.css" />
	<?php 
	//Necessary in <head> for JS and plugins to work. 
	//I like it before style.css loads so the theme stylesheet is more specific than all others.
	wp_head();  ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo esc_url( get_stylesheet_uri() )   ?>" />
</head>
<body <?php body_class(); ?>>	
	<div id="wrapper">
		<header role="banner" class="top-bar clearfix">
			

				<?php //get the phone number from the options table
				$values = get_option( 'rad_options' );
				if($values){
					?>
					<div class="contact-info">
						<tel><?php echo $values['phone']; ?></tel>
						<address><?php echo $values['address'] ?></address>
					</div>
				<?php } ?>

				<!--<img src="<?php header_image(); ?>">-->

				<h1 class="site-name">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"> 
						<?php bloginfo('name'); ?> 
					</a>
				</h1>
				<h2 class="site-description"> <?php bloginfo('description'); ?> </h2>

				<?php wp_nav_menu( array(
					'theme_location' => 'main_nav', //one of the menu areas from functions.php
					'container' => 'nav', //div or nav
					'fallback_cb' => '', //prevent ugly list of pages if no menu is assigned
				) ); ?>

				<?php wp_nav_menu( array(
					'theme_location' => 'utilities', //area from functions.php
					'menu_class' => 'utilities', //for the ul tag class
					'container' => '', //no container div or nav
					'fallback_cb' => '',
				) ); ?>
				<?php 
				get_search_form(); //includes searchform.php if it exists, if not, this outputs the default search bar ?>	
			
		</header>