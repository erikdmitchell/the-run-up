<?php
/*
Plugin Name: MDW CMS
Description: Adds cusomtized functionality to the site to make WordPress super awesome.
Version: 1.0.6tru
Author: MillerDesignworks
Author URI: http://www.millerdesignworks.com
License: GPL2
@erikdmitchell
*/

require_once(plugin_dir_path(__FILE__).'inc/mdw-custom-post-types.php');
require_once(plugin_dir_path(__FILE__).'inc/mdw-custom-tax.php');
require_once(plugin_dir_path(__FILE__).'inc/admin-columns.php');
require_once(plugin_dir_path(__FILE__).'inc/mdw-meta-boxes/mdwmb-plugin.php');
require_once(plugin_dir_path(__FILE__).'inc/mdw-meta-boxes/ajax-meta-boxes.php'); // may roll into mdwmd-plugin
require_once(plugin_dir_path(__FILE__).'inc/custom-widgets.php');
require_once(plugin_dir_path(__FILE__).'admin-page.php');
require_once(plugin_dir_path(__FILE__).'/classes/slider.php'); // our bootstrap slider
require_once(plugin_dir_path(__FILE__).'/classes/social-media.php'); // our social media page
require_once(plugin_dir_path(__FILE__).'/updater/updater.php'); // our bitbucket updater stuff
require_once(plugin_dir_path(__FILE__).'/widgets/tag-cloud-extended.php'); // tag cloud widget, extended by EM

//require_once(plugin_dir_path(__FILE__).'mdw-cms-demo.php'); // our demo setup stuff

/**
	Setup our custom CMS here
**/
// add post types //
$args=array(
	'slides' => array(
		'supports' => array('title','thumbnail','revisions'),
		'taxonomies' => false
	),
	'sponsors' => array(
		'supports' => array('title','thumbnail','revisions'),
		'taxonomies' => false
	),
);
$mdw_custom_post_types->add_post_types($args);
?>
