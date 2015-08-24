/**
 * jquery maps "plugin"
 * version 1.0.1
 *
 */
(function( $ ){
	$.fn.mdwGoogleMap = function(options) {
		var opts=$.extend({
	    lat : 40.1303,
	    lng : -75.5153,
	    zoom : 5,
	    mapType : 'ROADMAP',
	    mapHeight : 400,
	    width : 500,
	    icon : 'http://www.google.com/intl/en_us/mapfiles/ms/micons/red-dot.png',
	    iconHover : 'http://www.google.com/intl/en_us/mapfiles/ms/micons/red-dot.png',
	    markers : false,
	    map : false,
	    bounds : '',
	    mapControls : '',
	    defaultControls : 0
		}, options, wp_map_options);

		var activeWindow;
    opts.$elem=$(this);

		// force ints //
		opts.defaultControls=parseInt(opts.defaultControls);

console.log(opts);

		var init = function() {
			opts.$elem.css({
				width : opts.width,
				height : opts.mapHeight
			});

			loadMap();
		};

	  var loadMap = function() {
			if (!opts.$elem.length) {
				return false;
			}

			opts.bounds=new google.maps.LatLngBounds();
	    var _latlng = new google.maps.LatLng(opts.lat,opts.lng);
	    var mapOptions = {
	      zoom: parseInt(opts.zoom),
	      center: _latlng,
	      mapTypeId: google.maps.MapTypeId[opts.mapType],
	      //mapTypeControl: true,
	      //mapTypeControlOptions: opts.mapControls
	      disableDefaultUI: opts.defaultControls
	    };

	    opts.map = new google.maps.Map(opts.$elem.get(0),mapOptions);

	    if (addMarkers())
				opts.map.fitBounds(opts.bounds);
		};

		/**
		 * add markers
		 */
		var addMarkers = function() {
			// no markers //
		  if (!opts.map || !opts.markers || opts.markers.length==0) {
				return false;
			}

			// cycle through and generate all markers //
			for (i in opts.markers) {
				addMarker(opts.markers[i]);
			}

			return true;
		};

	  var addMarker = function(options) {
			var markerOpts=$.extend({
		    mdwmaps_lat : false,
		    mdwmaps_lng : false,
		    icon : opts.icon,
		    iconHover : opts.iconHover
			}, options);

			var latlng=new google.maps.LatLng(markerOpts.mdwmaps_lat,markerOpts.mdwmaps_lng);

/*
	    var image = new google.maps.MarkerImage(
				markerOpts.icon, // image url
				null, // size is determined at runtime
				null, // origin is 0,0
				null, // anchor is bottom center of the scaled image
				new google.maps.Size(30,30) // size
			);
	    var imageHover = new google.maps.MarkerImage(
				markerOpts.iconHover, // image url
				null, // size is determined at runtime
				null, // origin is 0,0
				null, // anchor is bottom center of the scaled image
				new google.maps.Size(30,30) // size
			);
*/

			var contentString = '<h1>'+markerOpts.post_title+'</h1>'+'<div class="content">'+markerOpts.post_content+'</div>';
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

	   	var marker = new google.maps.Marker({
				map: opts.map,
				position: latlng,
				// icon: image,
				//title: markerOpts.post_title
			});

			opts.bounds.extend(marker.position); // extend our bounds to include each markers position

			// open window //
			google.maps.event.addListener(marker, 'click', function() {
				// close active window if exitst //
				if (activeWindow!=null)
					activeWindow.close();

				// open new window //
				infowindow.open(opts.map,marker);

				// store new window as active //
				activeWindow=infowindow;
			});

			// close window if map click (outside window) //
			google.maps.event.addListener(opts.map,'click', function(event) {
				// close active window if exitst //
				if (activeWindow!=null)
					activeWindow.close();
			});

/*
			google.maps.event.addListener(marker, 'mouseover', function() {
	    	marker.setIcon(imageHover);
	    });
	    google.maps.event.addListener(marker, 'mouseout', function() {
	    	marker.setIcon(image);
	    });
*/

		};

		init();

	};
})( jQuery );
