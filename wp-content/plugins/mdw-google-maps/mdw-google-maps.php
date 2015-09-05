<?php
/**
 * Plugin Name: MDW Google Maps
 * Plugin URI:
 * Description: Allows custom integration of Google Maps into a WordPress site.
 * Version: 1.0.2
 * Author: erikdmitchell
 * Author URI:
 * Text Domain:
 * Network: true (not tested)
 * License: GPL2
 */

require_once(plugin_dir_path(__FILE__).'metabox.php');
require_once(plugin_dir_path(__FILE__).'admin.php');

function MDWGoogleMaps_is_active() {
	return true;
}

class MDWGoogleMaps {

	public $version='1.0.1';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_action('wp_enqueue_scripts',array($this,'scripts_styles'));
		add_action('admin_enqueue_scripts',array($this,'admin_scripts_styles'));

		add_shortcode('mdw-gmap',array($this,'mdw_gmap'));
	}

	/**
	 * scripts_styles function.
	 *
	 * @access public
	 * @return void
	 */
	public function scripts_styles() {
		global $MDWGoogleMapsAdmin;

		wp_enqueue_script('googleMaps','http://maps.googleapis.com/maps/api/js?key='.$MDWGoogleMapsAdmin->settings['google_api_key'].'&sensor=true');
		wp_enqueue_script('mdw-google-maps-map-script',plugins_url('/js/mdw-google-maps-map.js',__FILE__),array('googleMaps'),'1.0.0',true);
		wp_enqueue_script('mdw-google-maps-functions-script',plugins_url('/js/functions.js',__FILE__),array('mdw-google-maps-map-script'),'1.0.0',true);
	}

	/**
	 * admin_scripts_styles function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_scripts_styles() {
		wp_enqueue_style('mdw-gmaps-admin-style',plugins_url('/css/admin.css',__FILE__));

		wp_enqueue_script('googleMaps','http://maps.googleapis.com/maps/api/js?key=AIzaSyDEGzPwTMm2ttZ25HX53zHOIurqLUswYTY&sensor=true',array(),'');
		wp_enqueue_script('mdw-google-maps-geocode-script',plugins_url('/js/mdw-google-maps-geocode.js',__FILE__),array('googleMaps')); // may be admin only?
		wp_enqueue_script('mdwmaps-admin-functions-script',plugins_url('/js/admin-functions.js',__FILE__),array(),'1.0.0',true);
	}

	/**
	 * mdw_gmap function.
	 *
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	public function mdw_gmap($atts) {
		global $post,$MDWGoogleMapsAdmin;

		$args=array();
		extract( $atts = shortcode_atts( array(
			'lat' => false,
			'lng' => false,
			'posts' => array(),
			//'post_type' => false, // not used yet -- utalized in get_maps_post, set via admin panel
		), $atts) );
		$html=null;

		// check for posts //
		if (!is_array($posts))
			$posts=array($posts);

		// if no posts, specified - grab posts based on admin //
		if (empty($posts) && !$lat && !$lng)
			$posts=apply_filters('mdw_gmaps_get_maps_posts',$this->get_maps_posts(),$MDWGoogleMapsAdmin->settings);

		// generate markers //
		if ($posts) :
			foreach ($posts as $post) :
				$args['markers'][]=apply_filters('mdw_gmaps_add_marker',$post);
			endforeach;
		elseif ($lat && $lng) :
			$post=$this->append_map_info($post->ID);
			$args['markers'][]=$post;
		endif;

		// append variables from settings //
		$args=array_merge($args,$MDWGoogleMapsAdmin->settings);

		wp_localize_script('mdw-google-maps-map-script','wp_map_options',$args); // localize php/wp variables

		$html.='<div class="mdw-gmap"></div>'; // put out our div

		return $html;
	}

	/**
	 * get_maps_posts function.
	 *
	 * @access public
	 * @param bool $show_non_maps (default: false) ~ @erikdmitchell wtf is this?
	 * @return void
	 */
	public function get_maps_posts($show_non_maps=false) {
		global $MDWGoogleMapsAdmin;

		$posts=array();
		$args=array(
			'posts_per_page' => -1,
			'post_type' => $MDWGoogleMapsAdmin->settings['post_type']
		);

		$_posts=get_posts(apply_filters('mdw_gmaps_get_maps_posts_args',$args));
		$all_posts=apply_filters('mdw_gmaps_get_maps_posts_func',$_posts,$args);

		if (!count($all_posts))
			return false;

		foreach ($all_posts as $key => $post) :
			if (is_int($post)) :
				$post=get_post($post);
			elseif (!is_object($post)) :
				continue;
			endif;

			if (isset($post->ID))
				$post=$this->append_map_info($post->ID);

			if ($show_non_maps) :
				$posts[]=$post;
			elseif (isset($post->mdwmaps_lat)) :
				$posts[]=$post;
			endif;
		endforeach;

		return $posts;
	}

	/**
	 * append_map_info function.
	 *
	 * @access public
	 * @param int $post_id (default: 0)
	 * @return void
	 */
	public function append_map_info($post_id=0) {
		global $MDWGoogleMapsAdmin;

		if (!$post_id)
			return false;

		$post=apply_filters('mdw_gmaps_append_map_info_post',get_post($post_id),$post_id);
		$post=$this->get_location_meta($post);
		$post->post_content=apply_filters('mdw_gmaps_post_content',$post->post_content,$post,$post_id);

		return $post;
	}

	public function get_location_meta($post=0) {
		global $MDWGoogleMapsMetabox;

		$meta=array();

		if (!$post)
			return false;

		if (get_post_meta($post->ID,$MDWGoogleMapsMetabox->wp_meta_value,true))
			$meta=get_post_meta($post->ID,$MDWGoogleMapsMetabox->wp_meta_value,true);

		$mdwmaps_meta=apply_filters('mdw_gmaps_get_post_meta',$meta,$post->ID);

		foreach ($mdwmaps_meta as $meta_name => $meta_value) :
			$post_key='mdwmaps_'.$meta_name;
			$post->$post_key=$meta_value;
		endforeach;

		return $post;
	}

}

new MDWGoogleMaps();

/*
admin settings page (removee)
	called: admin geocode

Custom post types: (removeD)
	called: geocode

// -- add a button to the TinyMCE interface -- //
add_action('init', 'add_button');

function add_button() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons', 'register_button');
   }
} // end function add_button //

function register_button($buttons) {
   array_push($buttons, "map");
   return $buttons;
} // end register_button //

function add_plugin($plugin_array) {
   $plugin_array['map'] = plugins_url('js/mceplugin.js',__File__);
   return $plugin_array;
} // end add_plugin //
*/

/**
 * runs our update functions
 * updater json: http://www.millerdesignworks.com/mdw-wp-plugins/mdw-google-maps.json
 * udater zip url: http://www.millerdesignworks.com/mdw-wp-plugins/mdw-google-maps.zip
 */
require_once(plugin_dir_path(__FILE__).'updater/plugin-update-checker.php');
if (class_exists('PucFactory')) :
	$MyUpdateChecker = PucFactory::buildUpdateChecker (
	    'http://www.millerdesignworks.com/mdw-wp-plugins/mdw-google-maps.json',
	    __FILE__,
	    'mdw-google-maps'
	);
endif;
?>