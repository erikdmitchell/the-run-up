<?php
/*
Plugin Name: Top 25 Plugin
Description: A WordPress plugin for EMdotNET Top 25 Riders program.
Version: 1.5.7
Author: Erik Mitchell
Author URI: http://www.erikmitchell.net
*/

include(plugin_dir_path(__FILE__).'db_setup.php');
include(plugin_dir_path(__FILE__).'top25_shortcode.php');

function top25_reg_admin_scripts() {
	wp_register_script('menuMod',plugins_url('js/menuMod.js',__File__));
	wp_register_script('voteJS',plugins_url('js/vote.js',__File__));
	wp_register_script('dateBox',plugins_url('js/datebox.js',__File__));
}
add_action('admin_init','top25_reg_admin_scripts');

function top25_enq_admin_scripts_styles() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('voteJS');
	wp_enqueue_script('dateBox');
	
	wp_enqueue_style('top25-admin-style',plugins_url('css/admin.css',__File__));
	wp_enqueue_style('jqueryUI-style','http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css');
}

function top25_admin_actions() {
	$page[]=add_menu_page("Top 25","Top 25",'administrator',"top25-admin","top25_admin");
	$page[]=add_submenu_page("top25-admin","Setup Week","Setup Week",'administrator',"top25-week","top25_week"); 
	$page[]=add_submenu_page("top25-admin","Vote","Vote",'administrator',"top25-vote","top25_vote"); 
	//$page[]=add_submenu_page("top25-admin","cURL","cURL",'administrator',"top25-curl","top25_curl"); 
	// our "hidden" pages //	
	$page[]=add_submenu_page("","Upload","Upload",'administrator',"top25-upload","top25_upload"); // add our hidden upload page
	$page[]=add_submenu_page("","Week View","Week View",'administrator',"top25-week-view","top25_week_view"); // add our hidden view page
	$page[]=add_submenu_page("","Default Rider DB","Default Rider DB",'administrator',"db-install-rider-data","db_install_rider_data"); // add our hidden db install data page
	$page[]=add_submenu_page("","Delete","Delete",'administrator',"top25-delete","top25_delete");
	$page[]=add_submenu_page("","Generate Shortcode","Generate Shortcode",'administrator',"top25-shortcode","top25_shortcode");
			
	include ('admin_settings_page.php');
	include ('top25_week_page.php');
	include ('top25_vote_page.php');
	include ('top25_upload_page.php');
	include ('top25_week_view.php');
	include ('db_top25_riders_default.php');
	include ('top25_delete.php');
	include ('top25-curl.php');
	
	foreach ($page as $p) {
		add_action('admin_print_scripts-'.$p,'top25_enq_admin_scripts_styles');
		
		if ($p=="toplevel_page_top25-admin") :
			wp_enqueue_script('jquery');
			wp_enqueue_script('admin-settings',plugins_url('js/admin-settings.js',__File__),array('jquery'));
		endif;
	}
}
add_action('admin_menu','top25_admin_actions');


function top25_enq_scripts_styles() {
	wp_enqueue_style('top25-style',plugins_url('css/shortcode.css',__File__));
}
add_action('init','top25_enq_scripts_styles');

define('TOP25_PATH',plugin_dir_path(__FILE__));
define('TOP25_SEASONS_TABLE',$wpdb->prefix.'top25_seasons');

function prefix_on_deactivate() {
	global $wpdb;
	
	delete_option("top25_db_version");
	
	$table_name=$wpdb->prefix."top25_races";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	
	$table_name=$wpdb->prefix."top25_rank";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	
	$table_name=$wpdb->prefix."top25_riders";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	
	$table_name=$wpdb->prefix."top25_seasons";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	
	$table_name=$wpdb->prefix."top25_votes";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");

}
register_uninstall_hook(__FILE__, 'prefix_on_deactivate');
?>