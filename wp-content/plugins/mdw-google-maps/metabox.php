<?php
/**
 * MDWGoogleMapsMetabox class.
 */
class MDWGoogleMapsMetabox {

	public $wp_meta_value='_mdwgmaps';

	protected $mb_id='mdw_gmaps_metabox';
	protected $plugin_textdomain='mdw_gmaps';

	private $nonce_field='mdw_google_maps_metabox';
	private $nonce_field_nonce='mdw_google_maps_metabox_nonce';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action('add_meta_boxes',array( $this,'add_meta_box'));
		add_action('save_post',array( $this,'save'));
	}

	/**
	 * add_meta_box function.
	 *
	 * @access public
	 * @return void
	 */
	public function add_meta_box() {
		global $MDWGoogleMapsAdmin;

		$post_types=array($MDWGoogleMapsAdmin->settings['post_type']);

    if ( in_array( get_post_type(), $post_types )) {
	    $mb_title=apply_filters('mdw_gmaps_metabox_title','MDW Google Maps');
			add_meta_box(
				$this->mb_id,
				__( $mb_title, $this->plugin_textdomain ),
				array( $this, 'metabox' ),
				get_post_type(),
				'advanced',
				'high'
			);
		}
	}

	/**
	 * metabox function.
	 *
	 * @access public
	 * @param mixed $post
	 * @return void
	 */
	public function metabox( $post ) {
		wp_nonce_field($this->nonce_field,$this->nonce_field_nonce);

		$html=null;

		// Use get_post_meta to retrieve an existing value from the database.
		$address='';
		$city='';
		$state='';
		$lat='';
		$lng='';
		$meta=get_post_meta($post->ID,$this->wp_meta_value,true);

		if (is_array($meta))
			extract($meta);

		$html.='<div id="mdw-gmaps-metabox">';

			$html.='<div id="mdw-gmaps-results"></div>';

			$html.='<div class="field-row">';
				$html.='<label for="address">Address</label>';
				$html.='<textarea id="address" name="mdwgmaps[address]" data-parent="mdw-gmaps">'.$address.'</textarea>';
			$html.='</div>';

			$html.='<div class="field-row">';
				$html.='<label for="city">City</label>';
				$html.='<input type="text" id="city" name="mdwgmaps[city]" value="'.$city.'" data-parent="mdw-gmaps" />';
			$html.='</div>';

			$html.='<div class="field-row">';
				$html.='<label for="state">State</label>';
				$html.='<input type="text" id="state" name="mdwgmaps[state]" value="'.$state.'" data-parent="mdw-gmaps" />';
			$html.='</div>';

			$html.='<div class="field-row">';
				$html.='<label for="lat">Latitude</label>';
				$html.='<input type="text" id="lat" name="mdwgmaps[lat]" value="'.$lat.'" data-parent="mdw-gmaps" />';
			$html.='</div>';

			$html.='<div class="field-row">';
				$html.='<label for="lng">Longitude</label>';
				$html.='<input type="text" id="lng" name="mdwgmaps[lng]" value="'.$lng.'" data-parent="mdw-gmaps" />';
			$html.='</div>';

			$html.='<div id="mdw-existing-meta"></div>';

			$html.='<input name="geocode" type="button" class="button button-primary button-large" id="mdw-google-map-geocode" value="Geocode">';

			$html.='<input name="mdwgmaps-shortcode" type="button" class="button button-primary button-large mdwgmaps_shortcode" id="mdwgmaps-shortcode" value="Shortcode" disabled>';

		$html.='</div>';

		echo $html;
	}

	/**
	 * save function.
	 *
	 * @access public
	 * @param mixed $post_id
	 * @return void
	 */
	public function save( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST[$this->nonce_field_nonce] ) )
			return $post_id;

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST[$this->nonce_field_nonce], $this->nonce_field ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		// OK, its safe for us to save the data now. //

		// Sanitize the user input.
		//$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

		// Update the meta field.
		update_post_meta($post_id,$this->wp_meta_value,$_POST['mdwgmaps']);
	}

}

$MDWGoogleMapsMetabox = new MDWGoogleMapsMetabox();
?>