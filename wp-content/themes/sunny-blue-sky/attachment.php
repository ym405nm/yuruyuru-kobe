<?php get_header();?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php if ( ! empty( $post->post_parent ) ) : ?>
					<p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'sunny_blue_sky' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
						/* translators: %s - title of parent post */
						printf( __( '<span class="meta-nav">&larr;</span> %s', 'sunny_blue_sky' ), get_the_title( $post->post_parent ) );
					?></a></p>
				<?php endif; ?>

				<div <?php post_class(); ?>>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="font-1"><?php the_title(); ?></h2>
        <div class="postmetadata">
          <?php
          // _e('Filed under&#58;','sunny_blue_sky');
		  // the_tags('Tags: ', ', ', '<br />');
		  // _e( 'Posted in', 'sunny_blue_sky' );
		  // the_category(', ') ?>
          <?php _e('By','sunny_blue_sky');?>
          <?php the_author();?>
          |
						<?php
							printf( __( '<span class="%1$s">Published</span> %2$s', 'sunny_blue_sky' ),
								'meta-prep meta-prep-entry-date',
								sprintf( '<span class="post-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
									esc_attr( get_the_time() ),
									get_the_date()
								)
							);
							if ( wp_attachment_is_image() ) {
								echo ' <span class="meta-sep">|</span> ';
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Full size is %s pixels', 'sunny_blue_sky' ),
									sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
										wp_get_attachment_url(),
										esc_attr( __( 'Link to full-size image', 'sunny_blue_sky' ) ),
										$metadata['width'],
										$metadata['height']
									)
								);
							}
						?>
						<?php edit_post_link( __( 'Edit', 'sunny_blue_sky' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->

<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
							$attachment_width  = apply_filters( 'warmHome_attachment_size', 940 );
							$attachment_height = apply_filters( 'warmHome_attachment_height', 940 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
						?></a></p>

						
<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
						</div><!-- .entry-attachment -->
						<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

<div style="width:900px;">
<div class="alignleft"><?php previous_image_link( false ); ?></div>
<div class="alignright"><?php next_image_link( false ); ?></div>
</div><!-- #nav-below -->

<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sunny_blue_sky' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sunny_blue_sky' ), 'after' => '</div>' ) ); ?>


<?php comments_template(); ?>

<?php endwhile; ?></div>
<?php get_footer(); ?>
