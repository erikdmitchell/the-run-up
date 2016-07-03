<?php

/**
 * tru_scripts_styles function.
 *
 * @access public
 * @return void
 */
function tru_scripts_styles() {
	wp_enqueue_style('google-fonts-arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700,400italic');
	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts', 'tru_scripts_styles');
?>