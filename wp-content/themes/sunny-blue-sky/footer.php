</div><!--content-->
<?php if ( !is_attachment() ) get_sidebar(); ?>
<div class="clear"></div>
</div><!--main-body-->

<!-- Start: Footer -->
<div class="footer">
	<div class="inner">
<?php //............................................... ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-1') ) : ?>
  			<div class="footer-widget">
				<h3 class="font-1">Tag Cloud</h3>
			        <?php //wp_list_categories('show_count=1&title_li='); ?>
                    <?php $args = array(
					'smallest'                  => 10, 
					'largest'                   => 10,
					'unit'                      => 'pt', 
					'number'                    => 20,  
					'format'                    => 'list',
					'separator'                 => "",
					'orderby'                   => 'count', 
					'order'                     => 'DESC' );
					wp_tag_cloud($args); ?> 
			</div>
	<?php endif; ?>
    
<?php //............................................... ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-2') ) : ?>
    		<div class="footer-widget center">
				<h3 class="font-1">Calendar</h3>
				<?php get_calendar(); ?>
			</div>
	<?php endif; ?>
<?php //............................................... ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-area-3') ) : ?>
    		<div class="footer-widget right">	
                <h3 class="font-1">Recent Posts</h3>
                <ul>
                <?php
                    $args = array( 'numberposts' => '8' ,'post_status' => 'publish');
                    $recent_posts = wp_get_recent_posts( $args );
                    foreach( $recent_posts as $recent ){
                        echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.$recent["post_title"].'" >' .   $recent["post_title"].'</a> </li> ';
                    }
                ?>
                </ul>
			</div>
	<?php endif; ?>
<?php //............................................... ?> 
	<div class="clear"></div>
	</div><!--inner-->
 <?php // credits ?>   
    <div class="credits">
    	<span>Copyright &copy; <?php echo date("Y");?> <?php bloginfo('name'); ?>. All Rights Reserved.</span><br /><?php sunny_blue_sky_by(); ?>
    </div>
</div><!--footer-->
<!-- End: Footer -->





<?php wp_footer(); ?>
</body>
</html>
