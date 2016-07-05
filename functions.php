<?php

/**
 * tru_scripts_styles function.
 *
 * @access public
 * @return void
 */
function tru_scripts_styles() {
	wp_enqueue_script('tru-modals', get_stylesheet_directory_uri().'/js/modals.js', array('jquery'), '0.1.0', true);

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
}
add_action('wp_footer', 'tru_add_modals');

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
add_filter( 'wp_nav_menu_items', 'tru_loginout_menu_link', 10, 2 );
?>