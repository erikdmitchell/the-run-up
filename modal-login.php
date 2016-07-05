<div id="login-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <div class="emcl-login-form">
			<form id="custom_login_form" class="custom_form" action="" method="post">
				<fieldset>
					<p>
						<label for="custom_user_login">Username</label>
						<input name="custom_user_login" id="custom_user_login" class="required" type="text" />
					</p>
					<p>
						<label for="custom_user_pass">Password</label>
						<input name="custom_user_pass" id="custom_user_pass" class="required" type="password" />
					</p>
					<p class="buttons">
						<input type="hidden" name="custom_login_nonce" value="<?php echo wp_create_nonce('custom-login-nonce'); ?>" />
						<input id="custom_login_submit" class="btn-tru" type="submit" value="Login" />
					</p>
				</fieldset>
			</form>
			<?php emcl_login_extras(); ?>
		</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->