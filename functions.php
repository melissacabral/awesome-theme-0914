<?php
//turn on sleeping features
add_theme_support( 'post-thumbnails' );

//add tumblr-like post formats for different kinds of blog posts
add_theme_support( 'post-formats', array('gallery', 'video', 'image', 'quote') );

//customize appearance
add_theme_support( 'custom-background', array( 'default-color'  => '5f5d59' ));

//make forms html5-friendly
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

add_theme_support( 'automatic-feed-links' );

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

//required to define the maximum automatic width of embeds
if ( ! isset( $content_width ) ) $content_width = 740;

/**
 * Fix wp_title on home page
 */
add_filter( 'wp_title', 'awesome_wp_title' );
function awesome_wp_title( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return  get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
  }else{
  	return $title . ' ' . get_bloginfo( 'name' );
  }

}

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

/**
 * Enhance comment display
 */
add_action( 'wp_enqueue_scripts', 'awesome_comment_display' );
function awesome_comment_display(){
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}
















/**
 * Customization API
 */
//add_action( 'customize_register', 'awesome_theme_customizer' );
//
function awesome_theme_customizer( $wp_customize ) {
//Link color
	//create the setting and its defaults
	$wp_customize->add_setting(	'awesome_link_color', array( 'default'     => '#6bcbca',	));
	//add the UI control. this is a color picker control. Attach it to the setting. 
	$wp_customize->add_control(	new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'      => 'Link Color',
		'section'    => 'colors', //this is one of the panels that is given to you. you can make your own, too. 
		'settings'   => 'awesome_link_color', //the setting from above that this control controls!
		)
	));
//Text Color
	$wp_customize->add_setting(	'awesome_text_color', array(
		'default'     => '#ffffff',
	));
	//add the UI control. this is a color picker control. Attach it to the setting. 
	$wp_customize->add_control(	
		new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'      => 'Body Text Color',
		'section'    => 'colors', //this is one of the panels that is given to you. you can make your own, too. 
		'settings'   => 'awesome_text_color', //the setting from above that this control controls!
		)
	));
//Radio Option - Right or left hand sidebar?
	$wp_customize->add_section( 'awesome_layout_section' , array(
    'title'      => 'Layout',
    'priority'   => 30,) );
	$wp_customize->add_setting( 'awesome_layout', array( 'default' => 'right' ) );
	$wp_customize->add_control(
    	new WP_Customize_Control( $wp_customize, 'sidebar_layout', array(
            'label'          => 'Sidebar Position',
            'section'        => 'awesome_layout_section',
            'settings'       => 'awesome_layout',
            'type'           => 'radio',
            'choices'        => array(
                'left'   => 'Left',
                'right'  => 'Right',
            )
        )
    ));
}	
function awesome_customizer_css() {
	?>
	<style type="text/css">
	a { color: <?php echo get_theme_mod( 'awesome_link_color' ); ?>;  }
	body{color: <?php echo get_theme_mod( 'awesome_text_color' ); ?>; }
	<?php if(get_theme_mod('awesome_layout') == 'right'): ?>
		#sidebar{float:right;}
		#content{float:left;}
	<?php else: ?>
		#sidebar{float:left;}
		#content{float:right;}
	<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'awesome_customizer_css' );

//no close PHP