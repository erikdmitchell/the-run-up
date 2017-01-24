<?php

/**
 * tru_scripts_styles function.
 *
 * @access public
 * @return void
 */
function tru_scripts_styles() {
	wp_enqueue_script('tru-front-page-script', get_stylesheet_directory_uri().'/js/front-page.js', array('jquery'), '0.1.0', true);
	wp_enqueue_script('tru-team-script', get_stylesheet_directory_uri().'/js/team.js', array('jquery'), '0.1.0', true);

	wp_enqueue_style('google-fonts-arvo', 'https://fonts.googleapis.com/css?family=Arvo:400,700,400italic');
	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts', 'tru_scripts_styles');

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
	get_template_part('template-parts/registration', 'form');
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
	if (empty($_POST['team_name']) || !empty($_POST['team_name']) && trim($_POST['team_name'])=='') {
		$errors->add('team_name_error', __('<strong>ERROR</strong>: You must include a team name.', 'tru'));
	}

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
	fantasy_cycling_create_team($user_id, $_POST['team_name']);

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

/**
 * tru_theme_setup function.
 *
 * @access public
 * @return void
 */
function tru_theme_setup() {
    add_image_size('single', 1400, 480, true ); // (cropped)
    add_image_size('blog-landing', 1200, 400, true);
}
add_action('after_setup_theme', 'tru_theme_setup');

/**
 * tru_loginout_menu_link function.
 *
 * @access public
 * @param mixed $items
 * @param mixed $args
 * @return void
 */
function tru_loginout_menu_link( $items, $args ) {
	// primary nav //
   if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li class="logout"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li class="sign-in"><a href="'. wp_login_url() .'">'. __("Sign In") .'</a></li>';
      }
   }

  // footer 1 nav //
  if (isset($args->menu->slug) && $args->menu->slug=='footer-1') :
  	if (is_user_logged_in()) :
  		$items.='<li class="logout"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
  	else :
  		$items.='<li class="logout"><a href="'. wp_registration_url() .'">'. __("Sign Up") .'</a></li>';
  		$items.='<li class="logout"><a href="'. wp_login_url() .'">'. __("Sign In") .'</a></li>';
  	endif;
  endif;

   return $items;
}
add_filter('wp_nav_menu_items', 'tru_loginout_menu_link', 10, 2);

/**
 * tru_primary_nav_menu_args function.
 *
 * @access public
 * @param string $args (default: '')
 * @return void
 */
function tru_primary_nav_menu_args( $args = '' ) {
	if ($args['theme_location']!='primary')
		return $args;

	if ( is_user_logged_in() ) {
		$args['menu'] = 'Primary Nav Logged In';
	} else {
		$args['menu'] = 'Primary Nav Logged Out';
	}

	return $args;
}
add_filter('wp_nav_menu_args', 'tru_primary_nav_menu_args');

/**
 * tru_faqs_shortcode function.
 *
 * @access public
 * @param string $atts (default: '')
 * @return void
 */
function tru_faqs_shortcode($atts='') {
	$html='';
	$posts=get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'faq',
		'orderby' => 'menu_order',
	));

	$html.='<div class="tru-faqs">';
		$html.='<ul class="tru-faqs-list">';
			foreach ($posts as $post) :
				$html.='<li id="faq-'.$post->ID.'" class="faq">';
					$html.='<h2 class="faq-title">'.$post->post_title.'</h2>';
					$html.='<div class="faq-content">'.apply_filters('the_content', $post->post_content).'</div>';
				$html.='</li>';
			endforeach;
		$html.='</ul>';
	$html.='</div>';

	return $html;
}
add_shortcode('tru_faqs', 'tru_faqs_shortcode');

/**
 * tru_add_rider_modal_navigation function.
 *
 * @access public
 * @param mixed $html
 * @param mixed $args
 * @return void
 */
function tru_add_rider_modal_navigation($html, $args) {
	$html=null;
	$prev_link=null;
	$next_link=null;

	// prev link //
	$prev_link.='<div class="prev-link">';

		if ($args['prev_page']!=0) :
			$prev_link.='<a href="'.$args['prev_page'].'"><button class="tru-add-riders-btn">'.$args['prev_text'].'</button></a>';
		else :
			$prev_link.='&nbsp;';
		endif;

	$prev_link.='</div>';

	// next link //
	$next_link.='<div class="next-link">';

		if ($args['next_page']<=$args['total']) :
			$next_link.='<a href="'.$args['next_page'].'"><button class="tru-add-riders-btn">'.$args['next_text'].'</button></a>';
		else :
			$next_link.='&nbsp;';
		endif;

	$next_link.='</div>';

	$html.='<div class="tru-add-riders-pagination add-riders-modal-pagination">';
		$html.=$prev_link;
		$html.=$next_link;
	$html.='</div>';

	return $html;
}
add_filter('fantasy_cycling_add_riders_modal_pagination', 'tru_add_rider_modal_navigation', 10, 2);

/**
 * tru_fantasy_cycling_display_add_remove function.
 *
 * @access public
 * @param mixed $html
 * @param mixed $plus
 * @param mixed $minus
 * @return void
 */
function tru_fantasy_cycling_display_add_remove($html, $plus, $minus) {
	$html=null;

	$html.='<a href="">';
		$html.='<i class="fa add-rider'.$plus.'" aria-hidden="true"><button class="tru-add-riders-btn">Add Rider</button></i>';
		$html.='<i class="fa fa-minus-circle'.$minus.'" aria-hidden="true"></i>';
	$html.='</a>';

	return $html;
}
add_filter('fantasy_cycling_display_add_remove', 'tru_fantasy_cycling_display_add_remove', 10, 3);

/**
 * tru_group_results_by_season function.
 *
 * @access public
 * @param string $results (default: '')
 * @return void
 */
function tru_group_results_by_season($results='') {
	$seasons=array();
	$results_by_season=array();

	// return if empty //
	if (empty($results))
		return $results;

	// get seasons //
	foreach ($results as $result) :
		$seasons[]=$result->season;
	endforeach;

	// remove dups and reset vals //
	$seasons=array_unique($seasons);
	$seasons=array_values($seasons);

	// add by seasons //
	foreach ($seasons as $season) :
		foreach ($results as $result) :
			if ($result->season==$season)
				$results_by_season[$season][]=$result;
		endforeach;
	endforeach;

	return $results_by_season;
}

/**
 * tru_navbar_classes function.
 *
 * @access public
 * @param string $classes (default: '')
 * @return void
 */
function tru_navbar_classes($classes='') {
	if (is_front_page()) :
		$classes.=' navbar-fixed-top';
	else :
		$classes.=' tru-header-nav';
	endif;

	echo $classes;
}

/**
 * tru_get_news function.
 *
 * @access public
 * @return void
 */
function tru_get_news() {
	$posts=get_posts(array(
		'category_name' => 'news'
	));

	return $posts;
}

/**
 * tru_team_roster_button_text function.
 *
 * @access public
 * @return void
 */
function tru_team_roster_button_text() {
	global $fantasy_cycling_user_team;

	if (!isset($fantasy_cycling_user_team->rider_ids) || empty($fantasy_cycling_user_team->rider_ids)) :
		echo 'Add riders to roster';
	else :
		echo 'Update roster';
	endif;
}

/**
 * tru_theme_posted_on function.
 *
 * @access public
 * @return void
 */
function tru_theme_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post"><span class="glyphicon glyphicon-pushpin"></span>' . __( 'Sticky', 'koksijde' ) . '</span>';
	}

	// Set up and print post meta information. -- hide date if sticky
	if (!is_sticky()) :
		echo '<span class="entry-date"><span class="glyphicon glyphicon-time"></span><time class="entry-date" datetime="'.get_the_date('c').'">'.get_the_date().'</time></span>';
	endif;
}

/**
 * tru_ordinal_number function.
 *
 * @access public
 * @param mixed $number
 * @return void
 */
function tru_ordinal_number($number) {
	$ends = array('th','st','nd','rd','th','th','th','th','th','th');
	if ((($number % 100) >= 11) && (($number%100) <= 13))
		return $number. 'th';
	else
		return $number. $ends[$number % 10];
}

/**
 * tru_excerpt_by_id function.
 * 
 * @access public
 * @param mixed $post
 * @param int $length (default: 25)
 * @param string $tags (default: '<a><em><strong>')
 * @param string $extra (default: '...')
 * @return void
 */
function tru_excerpt_by_id($post, $length=25, $tags='<a><em><strong>', $extra='...') {
	if (is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}
 
	if (has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}
 
	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
	$the_excerpt .= $extra;
 
	return apply_filters('the_content', $the_excerpt);
}
?>