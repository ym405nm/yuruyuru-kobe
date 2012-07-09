<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php
	/*
	 * Print the <title> tags.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add blog name.
	bloginfo( 'name' );

	// Add blog description for the home page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( 'Page %s', max( $paged, $page ) );

	?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="header-cont">
<div class="header">
	<p class="logo sitetitle"><a href="<?php echo home_url(); ?>/" class="font-1"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /><?php bloginfo('name'); ?></a>
    <span><?php bloginfo('description'); ?></span>
    </p>
	<div class="header-search-box"><?php get_search_form(); ?></div>
</div>
<div class="clear"></div>
</div><!--header-cont-->

<div class="header-menu">
	<?php wp_nav_menu( array('fallback_cb' => 'SunnyBlueSky_page_menu', 'menu' => 'primary', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '<span><span>', 'link_after' => '</span></span>') ); ?>
    <a class="home-button" href="<?php echo home_url(); ?>/">Home</a>
    <div class="search-button">&nbsp;</div>
</div>

<div class="main-body">
<div class="content">