<?php
/*
Plugin Name: Top 25 Plugin
Description: A WordPress plugin for EMdotNET Top 25 Riders program.
Version: 1.0
Author: Erik Mitchell
Author URI: http://www.erikmitchell.net
*/

include ("db_setup.php");
include ("top25_shortcode.php");

function top25_reg_admin_scripts() {
	wp_register_script('menuMod',plugins_url('js/menuMod.js',__File__));
	wp_register_script('voteJS',plugins_url('js/vote.js',__File__));
}
add_action('admin_init','top25_reg_admin_scripts');

function top25_enq_admin_scripts() {
	wp_enqueue_script('voteJS');
}

function top25_admin_actions() {
	$page[]=add_menu_page("Top 25","Top 25",'administrator',"top25-admin","top25_admin");
	$page[]=add_submenu_page("top25-admin","Setup Week","Setup Week",'administrator',"top25-week","top25_week"); 
	$page[]=add_submenu_page("top25-admin","Vote","Vote",'administrator',"top25-vote","top25_vote"); 
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
	
	foreach ($page as $p) {
		add_action('admin_print_scripts-'.$p,'top25_enq_admin_scripts');
	}
}
add_action('admin_menu','top25_admin_actions');

// enqueue scripts //
wp_enqueue_script('jquery');

// enqueue styles //
wp_enqueue_style('top25-style',plugins_url('css/main.css',__File__));

define('TOP25_PATH',plugin_dir_path(__FILE__));
?>