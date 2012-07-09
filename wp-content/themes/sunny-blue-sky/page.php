<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="font-1"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<div class="clear"></div>			
				<?php edit_post_link('Edit this page.', '<p>', '</p>'); ?>
		</div>
		
		<?php comments_template(); ?>
		
		<?php endwhile; endif; ?>

		

<?php get_footer(); ?>