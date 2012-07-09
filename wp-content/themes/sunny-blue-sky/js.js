jQuery().ready(function() {
// Drop down menu style
	jQuery('.header-menu ul ul ul').parent("li").addClass("sub");
	jQuery('.header-menu ul ul').parent().hover(function() {
		jQuery(this).children('ul').slideToggle("fast");
		jQuery(this).addClass('activeParent');
	},
	function() {
		jQuery(this).children('ul').fadeOut("fast");
		jQuery(this).removeClass('activeParent');
	});
// Search box
	var sform = '.header-search-box';
	jQuery('.search-button').click(function() {
		if (jQuery(sform).hasClass('active')) {
			jQuery(sform).fadeOut("fast");
			jQuery(sform).removeClass('active');
		} else {
			jQuery(sform).fadeIn("slow");
			jQuery(sform).addClass('active');
		}
	});
});
