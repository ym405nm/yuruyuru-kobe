<?php
// Register Sidebars
function SunnyBlueSky_sidebar() {
	register_sidebar(array(
		'name' => 'Sidebar Widget Area',
		'id' => 'sidebar-widget-area',
		'description' => 'The sidebar widget area',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-heading font-1">',
		'after_title' => '</h3>',        
	));
	register_sidebar( array(
		'name' => 'Footer Widget Area 1' ,
		'id' => 'footer-widget-area-1',
		'description' => 'Note: Position "left" and width: 300px',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="font-1">',
		'after_title' => '</h3>', 
	) );
	register_sidebar( array(
		'name' => 'Footer Widget Area 2',
		'id' => 'footer-widget-area-2',
		'description' =>  'Note: Position "center" and width: 300px' ,
		'before_widget' => '<div class="footer-widget center">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="font-1">',
		'after_title' => '</h3>', 
	) );
	register_sidebar( array(
		'name' =>  'Footer Widget Area 3',
		'id' => 'footer-widget-area-3',
		'description' => 'Note: Position "right" and width: 300px' ,
		'before_widget' => '<div class="footer-widget right">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="font-1">',
		'after_title' => '</h3>', 
	) );
}
add_action('widgets_init', 'SunnyBlueSky_sidebar');

// Basic theme setup.
function if_theme_setup() {
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 603; //Set content width
	// add_theme_support('post-formats',array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	add_editor_style();
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 110, 110, true ); // Default size
	add_custom_background();
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array('primary' => 'Header Menu'));
}
add_action( 'after_setup_theme', 'if_theme_setup' );

//Multi-level pages menu  
function SunnyBlueSky_page_menu() {
	if (is_page()) { $highlight = "page_item"; } else {$highlight = "menu-item current-menu-item"; }
	echo '<ul class="menu">';
	wp_list_pages('sort_column=menu_order&title_li=&link_before=<span><span>&link_after=</span></span>&depth=3');
	echo '</ul>';
} 
// Scripts
function sunny_blue_sky_enqueue_scripts() {
	if (!is_admin()):
		// google fonts api
		wp_register_style('sbs_google-fonts', 'http://fonts.googleapis.com/css?family=Ubuntu+Condensed');
		wp_enqueue_style( 'sbs_google-fonts');
		// custom jquery js script
		wp_register_script('sbs_custom_script',
			   get_template_directory_uri() . '/js.js',
			   array('jquery'),
			   '1.0', false );
		wp_enqueue_script('sbs_custom_script');
	endif;
}
add_action('init', 'sunny_blue_sky_enqueue_scripts');

// Make theme available for translation BETA
// Translations in a /languages/ directory
//load_theme_textdomain('SunnyBlueSky', get_template_directory() . '/languages');

//password protections page change
function SunnyBlueSky_the_password_form() {
    global $post;
    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . get_option('siteurl') . '/wp-pass.php" method="post">'.
    '<p>My post is password protected. Please ask me for a password:</p> Password<input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit"'.
    'name="Submit" value="' . esc_attr__("Submit") . '" /></p></form>';

    return $output;
}
add_filter('the_password_form', 'SunnyBlueSky_the_password_form');

// Post meta data
function sunny_blue_sky_post_meta() {?>
<div class="comment-bubble"><?php if ( comments_open() ) : comments_popup_link('<span title="No comments yet">0</span>', '<span title="1 comment">1</span>', '<span title="% comments">%</span>', 'count'); else: echo '<span title="Comments are disabled" class="count">Off&nbsp;</span>'; endif; ?></div>
<div class="entry-date toggle" title="Posted on <?php the_time('F j, Y l'); ?> at <?php the_time('g:i a'); ?>">
    <div class="d"><?php the_time('d') ?></div>
    <div class="m"><?php the_time('M') ?></div>
</div><!--entry-date-->
<?php
// Link to Parts
wp_link_pages(array('before' => '<p class="pagination"><strong>Pages: </strong> ',
													  'after' => '</p>',
													  'next_or_number' => 'number',
													  ));
// if no title:
if (!get_the_title() and !is_single()): ?> <a href="<?php the_permalink() ?>" rel="bookmark">&infin;</a><?php endif; ?>
<div class="clear"></div>
<?php if ( is_single() ):?>
<p class="meta">
    <span class="date"><?php the_time( get_option( 'date_format' ) ) ?></span>
    <span class="author">This post was written by <?php the_author_posts_link(); ?></span>
    <span class="cats"><b>Categories:</b> <?php the_category(' &bull; '); ?></span>
    <span class="tags"><?php the_tags('<b>Tagged with:</b> ',' &bull; ','<br />'); ?></span>
    <span class="comments"><?php comments_popup_link( 'No comments yet', '1 comment', '% comments', '', 'Comments are off for this post'); ?></span>
    <?php edit_post_link('&bull;Edit ', '', ''); ?>
</p>
<?php endif;
} // end post_meta func

// Replace Prev-Next Navigation Links to über numbered pagination
function sunny_blue_sky_navigation () {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    echo "<div class=\"pagination\">".
	paginate_links( array(
        'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => '&lsaquo;',
        'next_text' => '&rsaquo;'
    )).
	"</div>\n";
} // end function

// Returns a Continue Reading link for excerpts
function sunny_blue_sky_continue_reading_link() {
	return '<span class="more-link"><a href="'. esc_url( get_permalink() ) . '">' . __( '<span class="button button-small">Continue reading &rarr;</span>', 'sunny_blue_sky' ) . '</a></span>';
}

// Replaces "[...]".
function sunny_blue_sky_auto_excerpt_more( $more ) {
	return ' &hellip;' . sunny_blue_sky_continue_reading_link();
}
add_filter( 'excerpt_more', 'sunny_blue_sky_auto_excerpt_more' );

// Adds Continue Reading link to excerpts.
function sunny_blue_sky_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= sunny_blue_sky_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sunny_blue_sky_custom_excerpt_more' );
//
function sunny_blue_sky_by() {
	echo '<div class="by">
	<a href="http://wordpress.org/extend/themes/sunny-blue-sky" rel="nofollow"><img src="'.get_template_directory_uri().'/images/by-wp.png" alt="Free Download this WordPress Theme" /></a>
	<a href="http://dinozoom.com/"><img align="right" src="'.get_template_directory_uri().'/images/by.png" alt="WEB TASARIM" /></a>
	</div>';
}


// Header Style
function birdsite_header_style() {
?>
<style type="text/css">
.header {
   <?php if (get_header_image()): ?>
		background:url(<?php header_image(); ?>) no-repeat top left;
   <?php endif; ?>
}
<?php
	if ( 'blank' == get_header_textcolor() ) { ?>
		.header .sitetitle {
			display: none;
		}   
	<?php } else { ?>
		.header .sitetitle a, .header .sitetitle span {
			color: #<?php header_textcolor();?>;
		}
	<?php } ?>
</style>
<?php 
}

// Admin Header Style
function birdsite_admin_header_style() {
?>
<style type="text/css">
.header {
   width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
   height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
   background:url(<?php header_image(); ?>) top left no-repeat;
}
#headimg {
	background:#BAF0F0;
}
#headimg h1, #headimg #desc {
	display:block;
	float: left;
	padding:15px 0 0 35px;
}
#headimg h1,
#headimg h1 a {
	width:100%;
	margin:0;
	color: #<?php header_textcolor();?>;
	font: bold 34px Arial,sans-serif;
	text-decoration: none;
	letter-spacing: 0;
	text-shadow: #000 -1px -1px 1px, #fff 1px 1px 1px;
}
#headimg #desc {
	font-size:12px;
	color:#333;
	padding-top:0;
}
</style>
<?php
} 


// Add a way for the custom header
define( 'HEADER_TEXTCOLOR', '57CDCA' );
define( 'HEADER_IMAGE', '%s/images/header.png' );
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 972 ) );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 180 ) );
add_custom_image_header( 'birdsite_header_style', 'birdsite_admin_header_style' );



?>