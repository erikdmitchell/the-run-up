<div class="emcl-registration">
	<form id="custom_registration_form" class="custom_form" action="" method="POST">
		<fieldset>
			<p>
				<label for="custom_user_login_reg"><?php _e('Username'); ?></label>
				<input name="custom_user_login_reg" id="custom_user_login_reg" class="required" type="text"/>
			</p>
			<p>
				<label for="custom_user_email"><?php _e('Email'); ?></label>
				<input name="custom_user_email" id="custom_user_email" class="required" type="email"/>
			</p>
			<p>
				<label for="custom_user_first"><?php _e('First Name'); ?></label>
				<input name="custom_user_first" id="custom_user_first" type="text"/>
			</p>
			<p>
				<label for="custom_user_last"><?php _e('Last Name'); ?></label>
				<input name="custom_user_last" id="custom_user_last" type="text"/>
			</p>
			<p>
				<label for="password"><?php _e('Password'); ?></label>
				<input name="custom_user_pass" id="password" class="required" type="password"/>
			</p>
			<p>
				<label for="password_again"><?php _e('Password Again'); ?></label>
				<input name="custom_user_pass_confirm" id="password_again" class="required" type="password"/>
			</p>

			<?php do_action('emcl_registraion_before_recaptcha'); ?>

			<?php if (get_option('emcl-enable-recaptcha',false)) : ?>
				<p>
					<div class="g-recaptcha" data-sitekey="<?php echo get_option('emcl-recaptcha-site-key',''); ?>"></div>
				</p>
			<?php endif; ?>
			<p>
				<input type="hidden" name="custom_register_nonce" value="<?php echo wp_create_nonce('custom-register-nonce'); ?>"/>
				<input type="submit" class="btn-tru" value="<?php _e('Register'); ?>"/>
			</p>
		</fieldset>
	</form>
	<?php emcl_login_extras(array('loginout' => false,'register' => false,'password' => false)); ?>
</div>
