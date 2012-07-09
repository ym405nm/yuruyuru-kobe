<?php get_header(); ?>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<!-- Start: Post -->
                    <div class="post-container">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><a href="<?php the_permalink() ?>" class="font-1" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="entryContent">
						    <?php the_post_thumbnail(); ?>
							<?php the_excerpt(); ?>
						</div>
					</div>
                    <?php sunny_blue_sky_post_meta();?>
					<div class="clear"></div>
                    </div><!--post-container-->
					<!-- End: Post -->
				<?php endwhile; ?>
				<?php sunny_blue_sky_navigation();?>
			<?php else : ?>
				<h2 class="center">Not Found</h2>
				<p class="center">Sorry, but you are looking for something that isn't here.</p>
				<?php get_template_part('searchform'); ?>
			<?php endif; ?>
<?php get_footer(); ?>
