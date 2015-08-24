<?php

/**
 * theme_scripts_styles function.
 *
 * @access public
 * @return void
 */
function theme_scripts_styles() {
	wp_enqueue_style('google-fonts-arvo','http://fonts.googleapis.com/css?family=Arvo:400,700,400italic');
	wp_enqueue_style( 'parent-style',get_template_directory_uri().'/style.css');
	//wp_enqueue_style('the-run-up-style',get_stylesheet_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts','theme_scripts_styles');

function admin_scripts_styles($hook) {
	wp_enqueue_script('tru-admin-script',get_stylesheet_directory_uri().'/js/admin.js',array('jquery'));

	wp_enqueue_style('tru-admin-style',get_stylesheet_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts','admin_scripts_styles');

function tru_footer_template($template) {
	return get_stylesheet_directory(__FILE__).'/footer.php';
}
//add_filter('mdw_theme_single_page_footer_template','tru_footer_template');

/**
 * get_partners function.
 *
 * @access public
 * @return void
 */
function get_partners() {
	$html=null;
	$args=array(
		'posts_per_page' => -1,
		'post_type' => 'partners'
	);
	$partners=get_posts($args);

	if (!count($partners))
		return false;

	$html.='<div class="partners row">';
		foreach ($partners as $partner) :
			$html.='<div id="partner-'.$partner->ID.'" class="col-xs-4">';
				if (has_post_thumbnail($partner->ID)) :
					$html.=get_the_post_thumbnail($partner->ID,'post-thumbnail',array('class' => 'img-responsive'));
				else :
					$html.=get_the_title($partner->ID);
				endif;
			$html.='</div>';
		endforeach;
	$html.='</div>';

	return $html;
}

/**
 * get_schedule function.
 *
 * @access public
 * @return void
 */
function get_schedule() {
	$html=null;
	$args=array(
		'posts_per_page' => -1,
		'post_type' => 'races'
	);
	$races=get_posts($args);

	if (!count($races))
		return false;

	// order by date //
	usort($races, function ($a, $b) {
		return strcmp(strtotime(get_post_meta($a->ID,'_race_details_date',true)),strtotime(get_post_meta($b->ID,'_race_details_date',true)));
	});

	$html.='<div class="races">';
		$html.='<div class="row header">';
			$html.='<div class="date col-xs-3 col-sm-2">Date</div>';
			$html.='<div class="race col-xs-3">Race</div>';
			$html.='<div class="series hidden-xs col-sm-2">Series</div>';
			$html.='<div class="uci hidden-xs col-sm-1">UCI</div>';
			$html.='<div class="location col-xs-3 col-sm-3">Location</div>';
		$html.='</div>';
		foreach ($races as $race) :
			$location=array();
			$location_full=get_post_meta($race->ID,'_race_details_location',true);

			if ($location_full['city'])
				$location[]=$location_full['city'];

			if ($location_full['state'])
				$location[]=$location_full['state'];

			$html.='<div id="race-'.$race->ID.'" class="race row">';
				$html.='<div class="date col-xs-3 col-sm-2">'.get_post_meta($race->ID,'_race_details_date',true).'</div>';
				$html.='<div class="race col-xs-3">'.get_the_title($race->ID).'</div>';
				$html.='<div class="series hidden-xs col-md-2">'.get_post_meta($race->ID,'_race_details_series',true).'</div>';
				$html.='<div class="uci hidden-xs col-md-1">'.get_post_meta($race->ID,'_race_details_uci',true).'</div>';
				$html.='<div class="location col-xs-3">'.implode(', ',$location).'</div>';
			$html.='</div>';
		endforeach;
	$html.='</div>';

	return $html;
}

/**
 * tru_mdw_google_maps_admin_post_types function.
 *
 * add 'races' to maps meta
 *
 * @access public
 * @param mixed $post_types
 * @param mixed $post_type_args
 * @return void
 */
function tru_mdw_google_maps_admin_post_types($post_types,$post_type_args) {
    $post_types['races']='races';

    return $post_types;
}
add_filter('mdw_google_maps_admin_post_types','tru_mdw_google_maps_admin_post_types',10,2);

/**
 * tru_mdw_gmaps_get_post_meta function.
 *
 * @access public
 * @param mixed $meta
 * @param mixed $post_id
 * @return void
 */
function tru_mdw_gmaps_get_post_meta($meta,$post_id) {
	$address=get_post_meta($post_id,'_race_details_location',true);

	$meta=array(
		'address' => $address['line1'].' '.$address['line2'],
		'city' => $address['city'],
		'state' => $address['state'],
		'lat' => get_post_meta($post_id,'_race_details_latitude',true),
		'lng' => get_post_meta($post_id,'_race_details_longitude',true),
	);

	return $meta;
}
add_filter('mdw_gmaps_get_post_meta','tru_mdw_gmaps_get_post_meta',10,2);

/*
function schedule_container_classes($classes) {
	$classes=array('container-fulid');

	return $classes;
}
add_filter('mdw_single_page_section_container_classes_default_post-12','schedule_container_classes');
*/
?>