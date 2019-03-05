jQuery(document).ready(function($) {

	// sign in menu link click //
	$('#my-team-button').click(function(e) {
		e.preventDefault();

		window.location.href='/team/';
	});

});
jQuery(document).ready(function($) {

	// sign in menu link click //
	$('#my-team-button').click(function(e) {
		e.preventDefault();

		window.location.href='/team/';
	});

});
jQuery(document).ready(function($) {

	// when a rider is added to the roster //
	$('body').on('FCupdateRiderOnTeam', function(e, riderID) {
//console.log('FCupdateRiderOnTeam (add rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var emptyRider = '<div class="empty-add-rider"></div>';

		// clear wrap and then add our add code //
		//$wrap.html(emptyRider);
	});

	// when a rider is removed from the roster //
	$('body').on('FCenableRiderOnTeam', function(e, riderID) {
//console.log('FCenableRiderOnTeam (remove rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var $name = $rider.find('.name');
		//var riderName = $name.find('span').text();
		//var addRiderBtn = '<a href="#" class="add-rider" data-id="'+riderID+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>'

		// fix name link issue //
		//$name.html(riderName);

		// clear wrap and then add our add rider code //
		//$wrap.html(addRiderBtn);
	});

});
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
 * nav functions
 */
jQuery(document).ready(function($) {
    var $window = $(window);
    var $navbar = $('.navbar-nav');
    var $navbarToggle = $('.navbar-toggler');
    
    // hamburger nav.
    $navbarToggle.on('click', function() {        
        if ($navbar.hasClass('active')) {
            $navbar.css('display', 'none');
            $navbar.removeClass('active');
        } else {
            $navbar.css('display', 'flex');
            $navbar.addClass('active');            
        }
    });
    
    // sets up menu based on window size.
    function checkWidth() {
        var windowSize = $window.width();
        
        if (windowSize > 768) {
            $navbar.css('display', 'inline-block');    
        } else {
            $navbar.css('display', 'none');
        }
    }

    checkWidth();
    
    $(window).resize(checkWidth);
});
jQuery(document).ready(function($) {

	// when a rider is added to the roster //
	$('body').on('FCupdateRiderOnTeam', function(e, riderID) {
//console.log('FCupdateRiderOnTeam (add rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var emptyRider = '<div class="empty-add-rider"></div>';

		// clear wrap and then add our add code //
		//$wrap.html(emptyRider);
	});

	// when a rider is removed from the roster //
	$('body').on('FCenableRiderOnTeam', function(e, riderID) {
//console.log('FCenableRiderOnTeam (remove rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var $name = $rider.find('.name');
		//var riderName = $name.find('span').text();
		//var addRiderBtn = '<a href="#" class="add-rider" data-id="'+riderID+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>'

		// fix name link issue //
		//$name.html(riderName);

		// clear wrap and then add our add rider code //
		//$wrap.html(addRiderBtn);
	});

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
	$back_to_top = $('.tru-back-to-top');

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
 * nav functions
 */
jQuery(document).ready(function($) {
    var $window = $(window);
    var $navbar = $('.navbar-nav');
    var $navbarToggle = $('.navbar-toggler');
    
    // hamburger nav.
    $navbarToggle.on('click', function() {        
        if ($navbar.hasClass('active')) {
            $navbar.css('display', 'none');
            $navbar.removeClass('active');
        } else {
            $navbar.css('display', 'flex');
            $navbar.addClass('active');            
        }
    });
    
    // sets up menu based on window size.
    function checkWidth() {
        var windowSize = $window.width();
        
        if (windowSize > 768) {
            $navbar.css('display', 'inline-block');    
        } else {
            $navbar.css('display', 'none');
        }
    }

    checkWidth();
    
    $(window).resize(checkWidth);
});