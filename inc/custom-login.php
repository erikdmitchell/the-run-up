<?php
/**
 * tru_custom_login_head function.
 *
 * @access public
 * @return void
 */
function tru_custom_login_head() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/custom-login-styles.css" />';

	remove_action('login_head', 'wp_shake_js', 12); // remove shake when info is incorrect
}
add_action('login_head', 'tru_custom_login_head');

/**
 * tru_custom_login_logo_url function.
 *
 * @access public
 * @return void
 */
function tru_custom_login_logo_url() {
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'tru_custom_login_logo_url');

/**
 * tru_custom_login_logo_url_title function.
 *
 * @access public
 * @return void
 */
function tru_custom_login_logo_url_title() {
	return get_bloginfo('description');
}
add_filter('login_headertitle', 'tru_custom_login_logo_url_title');

/**
 * tru_edit_password_email_text function.
 *
 * @access public
 * @param mixed $text
 * @return void
 */
function tru_edit_password_email_text($text) {
	if ($text == 'Registration confirmation will be emailed to you.')
		$text='If you leave password fields empty one will be generated for you. Password must be at least eight characters long.';

	return $text;
}
add_filter('gettext', 'tru_edit_password_email_text');

/**
 * tru_override_registration_complete_message function.
 *
 * @access public
 * @param mixed $errors
 * @param mixed $redirect_to
 * @return void
 */
function tru_override_registration_complete_message($errors, $redirect_to) {
	if (isset($errors->errors['registered'])) :
		// Use the magic __get method to retrieve the errors array:
    $tmp=$errors->errors;

    // What text to modify:
    $old='Registration complete. Please check your email.';
    $new='Registration complete. Please log in.';

    // Loop through the errors messages and modify the corresponding message:
    foreach($tmp['registered'] as $index => $msg) :
    	if($msg === $old)
        $tmp['registered'][$index]=$new;
    endforeach;

    // Use the magic __set method to override the errors property:
    $errors->errors = $tmp;

    // Cleanup:
    unset($tmp);
  endif;

  return $errors;
}
add_filter('wp_login_errors', 'tru_override_registration_complete_message', 10, 2);

/**
 * tru_change_register_page_message function.
 *
 * @access public
 * @param mixed $message
 * @return void
 */
function tru_change_register_page_message($message) {
	if (strpos($message, 'Register For This Site') == true)
		$message = '';

	return $message;
}
add_filter('login_message', 'tru_change_register_page_message');


/**
 * tru_custom_login_redirect function.
 *
 * @access public
 * @param mixed $redirect_to
 * @param mixed $request
 * @param mixed $user
 * @return void
 */
function tru_custom_login_redirect($redirect_to, $request, $user) {
	global $user;

	if( isset( $user->roles ) && is_array( $user->roles ) ) {
		if( in_array( "administrator", $user->roles ) ) {
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter('login_redirect', 'tru_custom_login_redirect', 10, 3);

/**
 * tru_register_form function.
 *
 * @access public
 * @return void
 */
function tru_register_form() {
	get_template_part('../template-parts/registration', 'form');
}
add_action('register_form', 'tru_register_form');

/**
 * tru_registration_errors function.
 *
 * @access public
 * @param mixed $errors
 * @param mixed $sanitized_user_login
 * @param mixed $user_email
 * @return void
 */
function tru_registration_errors($errors, $sanitized_user_login, $user_email) {
	if (empty($_POST['team_name']) || !empty($_POST['team_name']) && trim($_POST['team_name'])=='') :
		$errors->add('team_name_error', __('<strong>ERROR</strong>: You must include a team name.', 'tru'));
	elseif (tru_team_name_in_use($_POST['team_name'])) :
		$errors->add('team_name_error', __('<strong>ERROR</strong>: Team name is in use.', 'tru'));
	endif;
	

	if (empty($_POST['first_name']) || !empty($_POST['first_name']) && trim($_POST['first_name'])=='') {
		$errors->add('first_name_error', __('<strong>ERROR</strong>: You must include a first name.', 'tru'));
	}

	if (empty($_POST['last_name']) || !empty($_POST['last_name']) && trim($_POST['last_name'])=='') {
		$errors->add('last_name_error', __('<strong>ERROR</strong>: You must include a last name.', 'tru'));
	}

	if (empty($_POST['password']) || !empty($_POST['password']) && trim($_POST['password'])=='') {
		$errors->add('password_error', __('<strong>ERROR</strong>: You must include a password.', 'tru'));
	}

	if (empty($_POST['repeat_password']) || (!empty($_POST['repeat_password']) && trim($_POST['repeat_password'])=='') || trim($_POST['password'])!=trim($_POST['repeat_password'])) {
		$errors->add('repeat_password_error', __('<strong>ERROR</strong>: You passwords do not match.', 'tru'));
	}

	if ($_POST['are_you_human'] != 2) {
		$errors->add('are_you_human_error', __('<strong>ERROR</strong>: You may not be human.', 'tru'));
	}

	return $errors;
}
add_filter('registration_errors', 'tru_registration_errors', 10, 3);

/**
 * tru_team_name_in_use function.
 * 
 * @access public
 * @param string $team_name (default: '')
 * @return void
 */
function tru_team_name_in_use($team_name='') {
	global $wpdb;
	
	if (empty($team_name))
		return true;
	
	$name=$wpdb->get_var("SELECT id FROM $wpdb->fantasy_cycling_teams WHERE name = '$team_name'");
	
	if ($name)
		return true;
		
	return false;
}

/**
 * tru_user_register function.
 *
 * @access public
 * @param mixed $user_id
 * @return void
 */
function tru_user_register($user_id) {
	$userdata=array();
	$userdata['ID']=$user_id;

	// add team name //
	fc_create_team($user_id, $_POST['team_name']);

	// setup more standard wp user fields //
	if (!empty($_POST['first_name']))
		$userdata['first_name']=trim($_POST['first_name']);

	if (!empty($_POST['last_name']))
		$userdata['last_name']=trim($_POST['last_name']);

	if (!empty($_POST['password']))
		$userdata['user_pass']=trim($_POST['password']);

	// update user //
	$new_user_id=wp_update_user($userdata);

}
add_action('user_register', 'tru_user_register');
