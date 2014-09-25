<?php
/* template name: Posts by Category */

get_header(); ?>
 

<main id="content">
 <?php
//get all the terms in the category taxonomy
// A term is an item of a taxonomy (e.g. "Apple" could be a term for the taxonomy "brand")
$terms = get_terms('category');
foreach( $terms as $term ):
?>
  <section class="category-<?php echo $term->name ?>">
    <h2 class="postmeta">Category: <?php echo $term->name;?></h2>
    <p class="description"><?php echo $term->description ?></p>
    <div class="<?php echo $term->post_type ?>-list">
      <?php
      //select posts in this category (term), and of a specified content type (post type) 
      $post_query = new WP_Query(array(
        'post_type' => 'post',
        'taxonomy' => $term->taxonomy,
        'term' => $term->slug,
        'nopaging' => true, // to show all posts in this category
      ));    

      //begin THE LOOP
      if( $post_query->have_posts() ): ?>
      	<?php while( $post_query->have_posts() ): $post_query->the_post(); ?>
      		       
      	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      		<h2 class="entry-title"> 
      			<a href="<?php the_permalink(); ?>"> 
      				<?php the_title(); ?> 
      			</a>
      		</h2>
      		<?php the_post_thumbnail('featured-img', array( 'class' => 'thumb' )); //featured image (activate in functions.php) ?>

        </article>
        <?php endwhile; ?>
      <?php endif;  //end THE LOOP(posts) ?>
      
    </div>
  </section>
<?php endforeach; //term ?>
</main>
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>