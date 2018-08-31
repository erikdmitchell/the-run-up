/**
 * mobile navigation function
 */

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

/**
 * hamburger nav
 */
jQuery(document).ready(function($) {
    var $navbar = $('.navbar-nav');
    var $navbarToggle = $('.navbar-toggler');
    
    $navbarToggle.on('click', function() {        
        if ($navbar.hasClass('active')) {
            $navbar.css('display', 'none');
            $navbar.removeClass('active');
        } else {
            $navbar.css('display', 'flex');
            $navbar.addClass('active');            
        }
    });

});