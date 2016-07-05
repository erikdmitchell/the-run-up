jQuery(document).ready(function($) {

	// sign in menu link click //
	$('.menu-item.login-modal').click(function(e) {
		e.preventDefault();

		launchLoginModal();
	});

	// register button in login modal //
	$('#login-modal .wp-register a').click(function(e) {
		e.preventDefault();

		closeLoginModal();
		launchRegistrationModal();
	});

	// join now button click //
	$('#join-now-button').click(function(e) {
		e.preventDefault();

		launchRegistrationModal();
	});

});

/**
 * launchLoginModal function.
 *
 * @access public
 * @return void
 */
function launchLoginModal() {
	jQuery('#login-modal').modal('show');
}

/**
 * closeLoginModal function.
 *
 * @access public
 * @return void
 */
function closeLoginModal() {
	jQuery('#login-modal').modal('hide');
}

/**
 * launchRegistrationModal function.
 *
 * @access public
 * @return void
 */
function launchRegistrationModal() {
	jQuery('#register-modal').modal('show');
}

/**
 * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
 */
jQuery(function() {
    function reposition() {
        var modal = jQuery(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');

        // Dividing by two centers the modal exactly, but dividing by three
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, (jQuery(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    jQuery('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    jQuery(window).on('resize', function() {
        jQuery('.modal:visible').each(reposition);
    });
});