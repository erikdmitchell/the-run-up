<?php
/**
 * get_mdw_single_page_header function.
 *
 * @access public
 * @return void
 */
function get_mdw_single_page_header() {
	$template=apply_filters('mdw_theme_single_page_header_template',dirname(__FILE__).'/templates/header.php');
	load_template($template);
}

/**
 * get_mdw_single_page_footer function.
 *
 * @access public
 * @return void
 */
function get_mdw_single_page_footer() {
	$template=apply_filters('mdw_theme_single_page_footer_template',dirname(__FILE__).'/templates/footer.php');
	load_template($template);
}

/**
 * mdw_single_page_content function.
 *
 * @access public
 * @return void
 */
function mdw_single_page_content() {
	$spc=new SinglePageContent();

	$spc->generate_content();
}
?>