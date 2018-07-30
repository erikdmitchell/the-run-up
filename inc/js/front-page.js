jQuery(document).ready(function($) {

	// sign in menu link click //
	$('#my-team-button').click(function(e) {
		e.preventDefault();

		window.location.href='/team/';
	});

});