<?php 

/**
 * Load custom login stylesheet.
 * 
 * @access public
 * @return void
 */
function tru_custom_login_stylesheet() {
    wp_enqueue_style( 'tru-custom-login', get_stylesheet_directory_uri() . '/inc/css/custom-login.css' );
}
add_action( 'login_enqueue_scripts', 'tru_custom_login_stylesheet' );

/**
 * Login logo URL.
 * 
 * @access public
 * @param mixed $url string.
 * @return void
 */
function tru_loginlogo_url($url) {
    return site_url();
}
add_filter( 'login_headerurl', 'tru_loginlogo_url' );