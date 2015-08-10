jQuery(document).ready(function($) {

	// tweak nav
	$('#menu-primary-navigation li a').click(function(e) {
		e.preventDefault();

		var linkSlug=$(this).attr('title').toLowerCase();
		var element=$('#'+linkSlug);

		$('#menu-primary-navigation li').each(function() {
			$(this).removeClass('active');
		});

		$(this).parent().addClass('active');

		scrollToDiv(element,40);

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