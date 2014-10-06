<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			
			<?php 
			//use the slider plugin if it exists
			if(function_exists('rad_slider')){
				rad_slider(); //defined in rad-slider plugin
			}else{
				the_post_thumbnail('slider-banner'); //featured image (activate in functions.php) 
			}
			?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
					
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('frontpage'); //include sidebar-frontpage.php ?>
<?php get_footer(); //include footer.php ?>