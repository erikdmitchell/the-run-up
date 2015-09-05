jQuery(document).ready(function($) {

	// swap out or nav normal links to internal //
	$('#menu-primary-navigation li a').each(function() {
		if ($('body').hasClass('home')) {
			var linkSlug=$(this).attr('title').toLowerCase();
			$(this).attr('href','#'+linkSlug);
		} else {
			var linkSlug=$(this).attr('title').toLowerCase();
			$(this).attr('href','/#'+linkSlug);
		}
	});

	// tweak nav with a scroll to //
	$('#menu-primary-navigation li a').click(function(e) {
		if (!$('body').hasClass('home'))
			return;

		e.preventDefault();

		var linkSlug=$(this).attr('title').toLowerCase();
		var element=$('#'+linkSlug);
		var navHeight=$('.navbar').outerHeight();

		$('#menu-primary-navigation li').each(function() {
			$(this).removeClass('active');
		});

		$(this).parent().addClass('active');

		scrollToDiv(element,navHeight);

		return false;
	});

});

function scrollToDiv(element,navheight){
	var offset = element.offset();
	var offsetTop = offset.top;
	var totalScroll = offsetTop-navheight;

	jQuery('body,html').animate({
		scrollTop: totalScroll
	}, 500);
}