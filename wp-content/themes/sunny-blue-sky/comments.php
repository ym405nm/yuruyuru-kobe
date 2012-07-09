<?php // Do not delete these lines
if ( post_password_required() ) : ?>
<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php return;
endif;?>
<?php
	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->
<?php if ($comments) : ?>
	<h3 id="comments" class="font-1"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ul class="commentlist">

	<?php wp_list_comments(); ?>

	</ul>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
	<!-- If comments are open, but there are no comments. -->
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
        <!--<p>Comments are currently closed.</p>-->
	<?php endif; ?>
<?php endif; ?>

<div class="comments-paginate"><?php paginate_comments_links('prev_text=prev&next_text=next'); ?></div>
<br />

<?php if ( comments_open() ) : ?>

<div class="comment-form"><?php comment_form(); ?></div>

<?php endif; // if you delete this the sky will fall on your head ?>



