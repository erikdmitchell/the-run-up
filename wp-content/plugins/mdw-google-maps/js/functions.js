// check variables //
if (typeof wp_map_options==='undefined') {
	wp_map_options=null;
}

jQuery(document).ready(function($) {

	// setup our map //
	$('.mdw-gmap').mdwGoogleMap();

});