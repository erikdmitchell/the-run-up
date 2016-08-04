<div id="custom-lost-password-form" class="em-lost-password custom-lost-password-form">

	<p><?php _e("Enter your email address and we'll send you a link you can use to pick a new password.",'dummy'); ?></p>

	<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
		<p class="form-row">
			<label for="user_login"><?php _e('Email', 'tru'); ?></label>
			<input type="text" name="user_login" id="user_login">
		</p>

		<p class="lostpassword-submit">
			<input type="submit" name="submit" class="btn-tru lostpassword-button" value="<?php _e('Reset Password', 'tru'); ?>" />
		</p>
	</form>
</div>