<div id="lost-password-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register</h4>
      </div>
      <div class="modal-body">

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

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->