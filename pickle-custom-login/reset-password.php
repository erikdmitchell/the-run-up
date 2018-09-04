<div class="row">
    <div class="col-6 offset-3">
        <div id="password-reset-form" class="password-reset-form">
            <h3><?php _e( 'Pick a New Password', 'dummy' ); ?></h3>
        
            <form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
                <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $_REQUEST['login'] ); ?>" autocomplete="off" />
                <input type="hidden" name="rp_key" value="<?php echo esc_attr( $_REQUEST['key'] ); ?>" />
        
                <p>
                    <label for="pass1"><?php _e( 'New password', 'dummy' ); ?></label>
                    <input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
                </p>
                <p>
                    <label for="pass2"><?php _e( 'Repeat new password', 'dummy' ); ?></label>
                    <input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
                </p>
        
                <p class="description"><?php echo wp_get_password_hint(); ?></p>
        
                <p class="resetpass-submit">
                    <input type="submit" name="submit" id="resetpass-button" class="button" value="<?php _e( 'Reset Password', 'dummy' ); ?>" />
                </p>
            </form>
        </div>
    </div>
</div>