jQuery(document).ready(function($) {

	// when a rider is added to the roster //
	$('body').on('FCupdateRiderOnTeam', function(e, riderID) {
//console.log('FCupdateRiderOnTeam (add rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var emptyRider = '<div class="empty-add-rider"></div>';

		// clear wrap and then add our add code //
		//$wrap.html(emptyRider);
	});

	// when a rider is removed from the roster //
	$('body').on('FCenableRiderOnTeam', function(e, riderID) {
//console.log('FCenableRiderOnTeam (remove rider)');
		//var $rider = $('.rider-list #rider-'+riderID);
		//var $wrap = $rider.find('.add-rider-wrap');
		//var $name = $rider.find('.name');
		//var riderName = $name.find('span').text();
		//var addRiderBtn = '<a href="#" class="add-rider" data-id="'+riderID+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>'

		// fix name link issue //
		//$name.html(riderName);

		// clear wrap and then add our add rider code //
		//$wrap.html(addRiderBtn);
	});

});