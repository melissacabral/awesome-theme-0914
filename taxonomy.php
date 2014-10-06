<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>

		<h2 class="archive-title">Products Filtered by: <?php single_term_title(); ?></h2>

		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			
			<?php the_post_thumbnail('thumbnail', array( 'class' => 'thumb' )); //featured image (activate in functions.php) ?>


			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			
			<div class="entry-content">
				<?php //logic!  show short content on 'archive views', show full content on single posts and pages 
				if( is_single() OR is_page() ){
					the_content(); //full content
				}else{
					the_excerpt(); //shortened content
				}
				?>

				<?php //the_meta();
				//get the price custom field
				//						$post ID, custom field key, single?
				$price = get_post_meta( $post->ID, 'price', true );
				?>
				<span class="product-price"><?php echo $price; ?></span>
			</div>
			
		</article><!-- end post -->

		<?php endwhile; ?>

		<section class="pagination">
			<?php 
			//if pagenavi plugin is available, use it
			if(function_exists('wp_pagenavi')){
				wp_pagenavi();
			}else{
				//pagenavi not available, use the standard wordpress navigation
				previous_posts_link( '&larr; Newer Posts' );
				next_posts_link( 'Older Posts &rarr;' );
			}
			?>
		</section>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>