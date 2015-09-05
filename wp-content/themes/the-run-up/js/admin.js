jQuery(document).ready(function($) {

	$('#_race_details_geocode').mdwGoogleMapGeoCode({
	    addressFieldID : '#_race_details_location_line1',
	    cityFieldID : '#_race_details_location_city',
	    stateFieldID : '#_race_details_location_state',
	    btnID : '#_race_details_geocode',
			latFieldID : '#_race_details_latitude',
			lngFieldID : '#_race_details_longitude',
	});

});