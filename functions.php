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
?>