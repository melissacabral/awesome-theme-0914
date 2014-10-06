<?php 
//Whatever we put here will show up when comments_template runs

//stop this file from running if this post is password protected
if( post_password_required() ){
	echo 'Enter the password to see the comments';
	return; //stop this file
}


//separate comment count from trackbacks and pingbacks count
$comments_by_type = &separate_comments( $comments );
$comment_count = count($comments_by_type['comment']);
$pings_count = count($comments_by_type['pings']);

?>
<section id="comments" class="clearfix">
	<h3 id="comments-title">
		<?php echo ( $comment_count == 1 ) ?  '1 Comment' :  $comment_count . ' Comments' ?> 
		<?php if( comments_open() ){ ?>		
			| <a href="#respond">Leave a Comment</a>
		<?php } ?>
	</h3>

	<div class="commentlist">
		<?php wp_list_comments(array(
			'type' 			=> 'comment', //list only real comments
			'avatar_size' 	=> 50, //px square
			'style'			=> 'div',
		)); ?>
	</div>

	<?php if( get_option( 'page_comments' ) AND get_comment_pages_count() > 1 ){ ?>
	<div class="pagination">
		<?php previous_comments_link(); ?>
		<?php next_comments_link(); ?>
	</div>
	<?php } ?>

	<?php comment_form(); ?>
</section>

<section id="trackbacks">
	<h3><?php echo $pings_count; ?> Sites Link Here:</h3>

	<ol>
		<?php wp_list_comments(array(
			'type' 	=> 'pings', //list only pingbacks and trackbacks
		)); ?>
	</ol>
</section>