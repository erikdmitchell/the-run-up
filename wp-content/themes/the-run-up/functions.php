<?php
function theme_scripts_styles() {
	wp_enqueue_style('google-fonts-arvo','http://fonts.googleapis.com/css?family=Arvo:400,700,400italic');
	wp_enqueue_style( 'parent-style',get_template_directory_uri().'/style.css');
	//wp_enqueue_style('the-run-up-style',get_stylesheet_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts','theme_scripts_styles');

function tru_footer_template($template) {
	return get_stylesheet_directory(__FILE__).'/footer.php';
}
//add_filter('mdw_theme_single_page_footer_template','tru_footer_template');
?>