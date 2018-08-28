/**
 * when a panel item (mobile nav) with children is clicked, this changes the +/- icon
 */
jQuery(document).on('click','.tru-mobile-menu .panel-heading.menu-item-has-children a, .tru-mobile-menu .panel-collapse .panel-heading a', function(e) {
	var $this=jQuery(this);

	if ($this.hasClass('collapsed')) {
		$this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
	} else {
		$this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
	}
});

/**
 * back to top button function
 */
jQuery(document).ready(function($) {
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300;
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	var offset_opacity = 1200;
	//duration of the top scrolling animation (in ms)
	var scroll_top_duration = 700;
	//grab the "back to top" link
	$back_to_top = $('.koksijde-back-to-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('btt-is-visible') : $back_to_top.removeClass('btt-is-visible btt-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('btt-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});

/*
 * jQuery offscreen plugin
 *
 * Filters that detect when an element is partially or completely outside
 * of the viewport.
 *
 *	Usage:
 *
 *		$('#element').is(':off-bottom')
 *
 * The above example returns true if #element's bottom edge is even 1px past
 * the bottom part of the viewport.
 *
 * Copyright Cory LaViska for A Beautiful Site, LLC. (http://www.abeautifulsite.net/)
 *
 * Licensed under the MIT license: http://opensource.org/licenses/MIT
 *
*/
(function($) {
	$.extend($.expr[':'], {
		'off-top': function(el) {
			return $(el).offset().top < $(window).scrollTop();
		},
		'off-right': function(el) {
			return $(el).offset().left + $(el).outerWidth() - $(window).scrollLeft() > $(window).width();
		},
		'off-bottom': function(el) {
			return $(el).offset().top + $(el).outerHeight() - $(window).scrollTop() > $(window).height();
		},
		'off-left': function(el) {
			return $(el).offset().left < $(window).scrollLeft();
		}
	});
})(jQuery);