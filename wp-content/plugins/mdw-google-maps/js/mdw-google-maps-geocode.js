/**
 * jquery geocode "plugin"
 * version 1.1.0
 *
 */
(function( $ ){
	$.fn.mdwGoogleMapGeoCode = function(options) {
//console.log(options);
		var opts=$.extend({
			geocoder : new google.maps.Geocoder(),
	    //lat : false,
	    //lng : false,
	    addressFieldID : '#mdw_gmaps_metabox #address',
	    cityFieldID : '#mdw_gmaps_metabox #city',
	    stateFieldID : '#mdw_gmaps_metabox #state',
	    //zip : false,
	    btnID : '#mdw-google-map-geocode',
	    resultsID : '#mdw-gmaps-results',
			latFieldID : '#mdw_gmaps_metabox #lat',
			lngFieldID : '#mdw_gmaps_metabox #lng',
			shortcodeBtnID : '#mdwgmaps-shortcode',
			existingMetaID : '#mdw-existing-meta',
			postboxIgnore : ['submitdiv','pageparentdiv','postimagediv'],
			inputTypesIgnore : ['button','hidden'],
			parentCheck : 'mdw-gmaps'
		}, options);

		opts.$elem=$(this); // not used?
//console.log(opts);
		var init = function() {
			//generateMetaFieldsList();

			// check for lat/lng and disable or undisable button //
			if ($(opts.latFieldID).val() && $(opts.lngFieldID).val())
				$(opts.shortcodeBtnID).prop('disabled',false);
		};

		var generateHTML = function() {
			//var btn='<input name="'+opts.btnID+'" type="button" class="button button-primary button-large" id="'+opts.btnID+'" value="Geocode">';
			//var results='<div id="'+opts.resultsID+'" class="mdw-google-map-geocode-result"></div>';

			//$('#'+opts.resultsID).append(results);
		};

		var buttonClick = function() {
			if ($(opts.latFieldID).val() && $(opts.lngFieldID).val()) {
				generateAddress(function(err,address) {
					if (err) {
						$(opts.resultsID).text(err).addClass('error');
						return;
					} else {
						$(opts.addressFieldID).val(address.raw.address);
						$(opts.cityFieldID).val(address.raw.city);
						$(opts.stateFieldID).val(address.raw.state);
						return;
					}
				});
			} else {
				generateLatLng(function(err,data) {
					if (err) {
						$(opts.resultsID).text(err).addClass('error');
						return;
					} else {
						$(opts.latFieldID).val(data[0].geometry.location.lat());
						$(opts.lngFieldID).val(data[0].geometry.location.lng());
						return;
					}
				});
			}
			return;
		};

		var generateAddress = function(cb) {

			var latlng = new google.maps.LatLng(opts.lat, opts.lng);

			opts.geocoder.geocode( { 'latLng': latlng}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var number = results[0].address_components[0].long_name;
					var street = results[0].address_components[1].long_name;
					var address = number+' '+street;
					var city = results[0].address_components[2].long_name;
					var state = results[0].address_components[4].short_name;
					var full_address = {
						'raw' : {
							'address' : address,
							'city' : city,
							'state' : state
						},
						'formatted' : address+'<br>'+city+', '+state
					}

					cb(null,full_address);
				} else {
					cb('Geocode was not successful for the following reason: ' + status);
				}
			});
		};

	  var generateLatLng = function(cb) {
			var final_address='';
			//var data='';

			if ($(opts.addressFieldID).val())
				final_address+=$(opts.addressFieldID).val()+' ';

			if ($(opts.cityFieldID).val())
				final_address+=$(opts.cityFieldID).val()+' ';

			if ($(opts.stateFieldID).val())
				final_address+=$(opts.stateFieldID).val()+' ';

	    opts.geocoder.geocode( { 'address': final_address}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	        cb(false,results);
	        $(opts.shortcodeBtnID).prop('disabled',false); // enable shortcode btn
	      } else {
	        cb('Geocode was not successful for the following reason: ' + status);
	      }
	    });
	  };

	  var generateShortcode = function() {
		  var lat=$(opts.latFieldID).val();
			var lng=$(opts.lngFieldID).val();
		  var shortcode='[mdw-gmap lat="'+lat+'" lng="'+lng+'" /]';

			window.parent.send_to_editor(shortcode);
			window.parent.tb_remove();
		}

/*
		var generateMetaFieldsList = function() {
			var availableFields=[];
			var ids=[];
			var classes=[];
			var vals=[]

			/**
			 * cycle through all postbox(es) - they're wp metaboxes
			 * we look for inputs with a value, then place it's id/class/value in the proper location
			 * it also checks the ids of our options, so that our own fields are not offered
			 */
/*
			$('.postbox').each(function() {
				if (!$(this).hasClass('hide-if-js') && opts.postboxIgnore.indexOf($(this).attr('id'))==-1) {
					$(this).find(':input').each(function() {
						if ($(this).val() && opts.inputTypesIgnore.indexOf($(this).attr('type'))==-1 && $(this).data('parent')!=opts.parentCheck) {
							if (typeof $(this).attr('id')!='undefined') {
								ids.push($(this).attr('id'));
							} else if (typeof $(this).attr('class')!='undefined') {
								classes.push($(this).attr('class'));
							} else {
								vals.push($(this).val());
							}
						}
					});
				}
			});

			availableFields['id']=ids;
			availableFields['classe']=classes;
			availableFields['val']=vals;

			for (key in availableFields) {
				for (i in availableFields[key]) {
					var value=availableFields[key][i];

					if (key=='id') {
						value=$('#'+availableFields[key][i]).val();
					} else if (key=='class') {
						value=$('.'+availableFields[key][i]).val();
					}

					var input='<input type="checkbox" name="" value=""> '+availableFields[key][i]+' ('+value+')<br />';
					$(opts.existingMetaID).append(input);
				}
			}

//opts.existingMeta

		}
*/
		/**
		 * sets up our geocode button click
		 */
		$(opts.btnID).click(function() {
			buttonClick();
		});

		/**
		 * sets up our shortcode button click
		 */
		$(opts.shortcodeBtnID).click(function() {
			generateShortcode();
		});

		/**
		 * checks lat/lng to enable/disable shortcode btn
		 */
		$(opts.latFieldID+','+opts.lngFieldID).on('change', function() {
			if ($(opts.latFieldID).val() && $(opts.lngFieldID).val()) {
				$(opts.shortcodeBtnID).prop('disabled',false);
			} else {
				$(opts.shortcodeBtnID).prop('disabled',true);
			}
		});

		init();

	};
})( jQuery );
