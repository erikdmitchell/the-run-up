<?php

/**
 * tru_scripts_styles function.
 *
 * @access public
 * @return void
 */
function tru_scripts_styles() {
	wp_enqueue_script('tru-modals', get_stylesheet_directory_uri().'/js/modals.js', array('jquery'), '0.1.0', true);
	wp_enqueue_script('tru-front-page-script', get_stylesheet_directory_uri().'/js/front-page.js', array('jquery'), '0.1.0', true);

	wp_enqueue_style('google-fonts-arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700,400italic');
	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts', 'tru_scripts_styles');

/**
 * tru_add_modals function.
 *
 * @access public
 * @return void
 */
function tru_add_modals() {
	get_template_part('modal', 'login');
	get_template_part('modal', 'register');
	get_template_part('modal', 'lost-password');
}
add_action('wp_footer', 'tru_add_modals');

/**
 * tru_loginout_menu_link function.
 *
 * @access public
 * @param mixed $items
 * @param mixed $args
 * @return void
 */
function tru_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li class="logout"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li class="sign-in"><a href="'. wp_login_url(get_permalink()) .'">'. __("Sign In") .'</a></li>';
      }
   }
   return $items;
}
add_filter( 'wp_nav_menu_items', 'tru_loginout_menu_link', 10, 2);

/**
 * tru_primary_nav_menu_args function.
 *
 * @access public
 * @param string $args (default: '')
 * @return void
 */
function tru_primary_nav_menu_args( $args = '' ) {
	if ( is_user_logged_in() ) {
		$args['menu'] = 'Primary Nav Logged In';
	} else {
		$args['menu'] = 'Primary Nav Logged Out';
	}

	return $args;
}
add_filter('wp_nav_menu_args', 'tru_primary_nav_menu_args');

/**
 * tru_after_user_reg_create_team function.
 *
 * @access public
 * @param mixed $user_id
 * @param mixed $params
 * @return void
 */
function tru_after_user_reg_create_team($user_id, $params) {
	fantasy_cycling_create_team($user_id, $params['tru_team_name']);
}
add_action('emcl_after_user_registration', 'tru_after_user_reg_create_team', 10, 2);

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
?>