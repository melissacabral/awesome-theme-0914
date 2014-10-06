<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			
			<?php the_post_thumbnail( 'large', array('class' => 'product-image') ); ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<div class="entry-content">
				<?php the_meta(); //show all custom fields in a list ?>
				
				<?php the_terms( $post->ID, 'brand', 'Brand: ' ); ?>

				<?php the_terms( $post->ID, 'feature', '<br />Features: ' ); ?>

				<?php the_content(); ?>
			</div>
			
		</article><!-- end post -->

		<section class="pagination">
			<?php 
			previous_post_link( '%link ', '%title' ); //older
			next_post_link( '%link', '%title' ); //newer
			?>
		</section>


		<?php endwhile; ?>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>