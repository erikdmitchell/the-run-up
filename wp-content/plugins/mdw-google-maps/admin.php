<?php
class MDWGoogleMapsAdmin {

	public $option='mdw_google_maps_settings';
	public $settings=array();

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		add_action('admin_menu',array($this,'admin_settings_page'));
		add_action('admin_enqueue_scripts',array($this,'admin_scripts_styles'));

		$this->settings=$this->setup_settings();
	}

	/**
	 * admin_settings_page function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_settings_page() {
		add_options_page('MDW GMaps','MDW GMaps','manage_options','mdw-gmaps-admin',array($this,'admin_page'));
	}

	/**
	 * admin_scripts_styles function.
	 *
	 * @access public
	 * @param mixed $hook
	 * @return void
	 */
	public function admin_scripts_styles($hook) {
		if ($hook!='settings_page_mdw-gmaps-admin')
			return false;

		wp_enqueue_style('bootstrap-grid-style',plugins_url('/css/bootstrap.css',__FILE__),array(),'3.3.5');
	}

	public function admin_page() {
		if (isset($_POST['settings-update']) && $_POST['settings-update'])
			$this->settings=$this->update_admin_options($_POST['gmaps']);

		$html=null;
		$pt_args=array(
			'public'   => true,
			'_builtin' => true
		);
		$post_types=apply_filters('mdw_google_maps_admin_post_types',get_post_types($pt_args),$pt_args);
		$zoom_max=19;

		$html.='<h2>MDW Google Maps Settings</h2>';

		$html.='<div class="mdw-gmaps-admin">';
			$html.='<form name="gmaps-settings col-xs-10" method="post">';

				$html.='<div class="general-settings section">';
					$html.='<h3>General Settings</h3>';
					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Google API Key';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<input type="text" name="gmaps[google_api_key]" id="google-api-key" class="regular-text" value="'.$this->settings['google_api_key'].'" />';
						$html.='</div><!-- .label -->';
					$html.='</div><!-- .row -->';

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Post Type';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<select name="gmaps[post_type]" id="post_type">';
								$html.='<option value="0">Select One</option>';
								foreach ($post_types as $type) :
									$html.='<option value="'.$type.'" '.selected($this->settings['post_type'],$type,false).'>'.ucwords($type).'</option>';
								endforeach;
							$html.='</select>';
						$html.='</div><!-- .label -->';
					$html.='</div><!-- .row -->';

					$html.=apply_filters('mdw_gmaps_general_settings_end','');

				$html.='</div><!-- .section -->';

				$html.='<div class="map-settings section">';
					$html.='<h3>Map Settings</h3>';
					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Width';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<input type="text" name="gmaps[width]" id="width" class="small-text" value="'.$this->settings['width'].'" />';
						$html.='</div><!-- .label -->';
					$html.='</div><!-- .row -->';

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Height';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<input type="text" name="gmaps[height]" id="height" class="small-text" value="'.$this->settings['height'].'" />';
						$html.='</div><!-- .label -->';
					$html.='</div><!-- .row -->';

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Default Map Type';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<select name="gmaps[mapType]" id="mapType">';
								$html.='<option value="ROADMAP" '.selected($this->settings['mapType'],'ROADMAP',false).'>ROADMAP</option>';
								$html.='<option value="SATELLITE" '.selected($this->settings['mapType'],'SATELLITE',false).'>SATELLITE</option>';
								$html.='<option value="HYBRID" '.selected($this->settings['mapType'],'HYBRID',false).'>HYBRID</option>';
								$html.='<option value="TERRAIN" '.selected($this->settings['mapType'],'TERRAIN',false).'>TERRAIN</option>';
							$html.='</select>';
						$html.='</div><!-- .label -->';
					$html.='</div><!-- .row -->';
/*
				$html.='<div class="row">';
					$html.='<div class="label col-md-2">';
						$html.='Add Map Control';
					$html.='</div><!-- .label -->';
					$html.='<div class="input col-md-10">';
						$rm_checked=null;
						$sat_checked=null;
						$hy_checked=null;
						$ter_checked=null;
						$checked='checked="checked"';

						if (in_array('google.maps.MapTypeId.ROADMAP',$this->settings['mapControls']['mapTypeIds']))
							$rm_checked=$checked;

						if (in_array('google.maps.MapTypeId.SATELLITE',$this->settings['mapControls']['mapTypeIds']))
							$sat_checked=$checked;

						if (in_array('google.maps.MapTypeId.HYBRID',$this->settings['mapControls']['mapTypeIds']))
							$hy_checked=$checked;

						if (in_array('google.maps.MapTypeId.TERRAIN',$this->settings['mapControls']['mapTypeIds']))
							$ter_checked=$checked;

						$html.='<input type="checkbox" name="gmaps[mapControls][mapTypeIds][]" value="google.maps.MapTypeId.ROADMAP" '.$rm_checked.'>ROADMAP<br />';
						$html.='<input type="checkbox" name="gmaps[mapControls][mapTypeIds][]" value="google.maps.MapTypeId.SATELLITE" '.$sat_checked.'>SATELLITE<br />';
						$html.='<input type="checkbox" name="gmaps[mapControls][mapTypeIds][]" value="google.maps.MapTypeId.HYBRID" '.$hy_checked.'>HYBRID<br />';
						$html.='<input type="checkbox" name="gmaps[mapControls][mapTypeIds][]" value="google.maps.MapTypeId.TERRAIN" '.$ter_checked.'>TERRAIN<br />';
					$html.='</div><!-- .label -->';
				$html.='</div><!-- .row -->';
*/

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Default Zoom';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<select name="gmaps[zoom]" id="zoom">';
								for ($i=0;$i<=$zoom_max;$i++) :
									$html.='<option value="'.$i.'" '.selected($this->settings['zoom'],$i,false).'>'.$i.'</option>';
								endfor;
							$html.='</select>';
						$html.='</div><!-- .input -->';
					$html.='</div><!-- .row -->';

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Disable Default Controls';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<input type="checkbox" name="gmaps[defaultControls]" id="default-controls" value="1" '.checked($this->settings['defaultControls'],1,false).'>';
						$html.='</div><!-- .input -->';
					$html.='</div><!-- .row -->';
				$html.='</div><!-- .section -->';

					$html.='<div class="row">';
						$html.='<div class="label col-xs-2">';
							$html.='Disable Scroll Wheel';
						$html.='</div><!-- .label -->';
						$html.='<div class="input col-xs-9">';
							$html.='<input type="checkbox" name="gmaps[scrollwheel]" id="scrollwheel" value="0" '.checked($this->settings['scrollwheel'],0,false).'> Mouse scroll wheel will no longer zoom in/out';
						$html.='</div><!-- .input -->';
					$html.='</div><!-- .row -->';
				$html.='</div><!-- .section -->';

				$html.='<div class="map-shortcode section">';
					$html.='<h3>Map Shortcode</h3>';

					$html.='<div class="row">';
						$html.='<div class="shortcode-description col-xs-12">';
							$html.='You can place this shortcode anywhere on the site. It acts just like any other WordPress shortcode. The shortcode generates a map with all locations that you have specified.';
						$html.='</div>';
					$html.='</div>';

					$html.='<div class="row">';
						$html.='<div class="shortcode-details label col-xs-2">';
							$html.='Shortcode';
						$html.='</div>';
						$html.='<div class="col-xs-9">';
							$html.='[mdw-gmap /]';
						$html.='</div>';
					$html.='</div>';

					$html.='<div class="row">';
						$html.='<div class="shortcode-atts label col-xs-2">';
							$html.='Shortcode Attributes';
						$html.='</div>';
						$html.='<div class="col-xs-9">';
							$html.='<div class="row">';
								$html.='<div class="label col-xs-3">';
									$html.='lat';
								$html.='</div>';
								$html.='<div class="col-xs-9">';
									$html.='The starting latitude for the map overview.';
								$html.='</div>';
							$html.='</div>';
							$html.='<div class="row">';
								$html.='<div class="label col-xs-3">';
									$html.='lng';
								$html.='</div>';
								$html.='<div class="col-xs-9">';
									$html.='The starting longitude for the map overview.';
								$html.='</div>';
							$html.='</div>';
							$html.='<div class="row">';
								$html.='<div class="label col-xs-3">';
									$html.='posts';
								$html.='</div>';
								$html.='<div class="col-xs-9">';
									$html.='(<i>Array</i>) Details coming soon.';
								$html.='</div>';
							$html.='</div>';
						$html.='</div>';
					$html.='</div>';
				$html.='</div><!-- .section -->';

				$html.='<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>';

				$html.='<input type="hidden" name="settings-update" id="settings-update" value="1" />';
			$html.='</form>';
		$html.='</div><!-- .mdw-gmaps-admin -->';

		echo $html;
	}

	/**
	 * setup_settings function.
	 *
	 * @access protected
	 * @param array $current_settings (default: array())
	 * @return void
	 */
	protected function setup_settings($current_settings=array()) {
		if (get_option($this->option))
			$current_settings=get_option($this->option);

		$default_settings=array(
			'google_api_key' => null,
			'post_type' => 'post',
			'width' => '100%',
			'height' => 550,
			'mapType' => 'ROADMAP',
			'mapControls' => array(
				'mapTypeIds' => array(),
			),
			'zoom' => 5,
			'defaultControls' => 0,
			'scrollwheel' => 1
			//'custom' => array(
				//'address_field' => false
			//),
		);

		$settings=array_replace_recursive($default_settings,$current_settings);

		return $settings;
	}

	/**
	 * update_admin_options function.
	 *
	 * @access protected
	 * @param array $data (default: array())
	 * @return void
	 */
	protected function update_admin_options($data=array()) {
		update_option($this->option,$data);

		return $this->setup_settings();
	}

}

$MDWGoogleMapsAdmin = new MDWGoogleMapsAdmin();
?>