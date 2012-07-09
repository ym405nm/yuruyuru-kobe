<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<!-- Start: Post -->
                    <div class="post-container">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><a href="<?php the_permalink() ?>" class="font-1" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="entryContent">
							<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                            <div class="clear"></div>
						</div>
					</div>
                    <?php sunny_blue_sky_post_meta();?>
					<div class="clear"></div>
                    </div><!--post-container-->
					<!-- End: Post -->
                    
	<?php comments_template(); ?>
	<?php endwhile; endif; ?>
<?php get_footer(); ?>
