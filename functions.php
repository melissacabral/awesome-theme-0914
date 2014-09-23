<?php
//turn on sleeping features
add_theme_support( 'post-thumbnails' );

//add tumblr-like post formats for different kinds of blog posts
add_theme_support( 'post-formats', array('gallery', 'video', 'image', 'quote') );

//customize appearance
add_theme_support( 'custom-background' );

//useful for banners or logo uploader
add_theme_support( 'custom-header', array( 
		'width' => 336,
	 	'height' => 80,
	 	));
//allow you to style the admin panel post editor window for better UX
//create a file called editor-style.css
add_editor_style();

//add any additional image sizes you need
//				(name, width, height, crop?)
add_image_size( 'featured-img', 200, 155, true );
add_image_size( 'slider-banner', 1300, 300, true );


/**
 * Make default excerpts better
 * @since 0.1
 */
function awesome_ex_length(){
	return 85; //words. default is 55
}
add_filter( 'excerpt_length', 'awesome_ex_length' );

//improve [...]
function awesome_readmore(){
	return ' <a href="'.get_permalink().'" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );

/**
 * Turn on Menu Support
 * @since 0.1
 */
add_action( 'init', 'awesome_menus' );
function awesome_menus(){
	register_nav_menus( array(
		'main_nav' => 'Main Navigation Area',
		'utilities' => 'Utility Bar area at the top',
	) );
}
/**
 * Set up Widget Areas (dynamic sidebars)
 * @since 0.1
 */
add_action( 'widgets_init', 'awesome_widget_areas' );
function awesome_widget_areas(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog-sidebar',
		'description' 	=> 'Appears alongside the blog and post archives',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id' 			=> 'home-area',
		'description' 	=> 'Appears near the bottom of the home page. Designed to hold 3 widgets.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id' 			=> 'page-sidebar',
		'description' 	=> 'Appears alongside page content',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer-area',
		'description' 	=> 'Appears at the bottom of everything',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );
}



//no close PHP