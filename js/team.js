jQuery(document).ready(function($) {

	// when a rider is added to the roster //
	$('body').on('FCupdateRiderOnTeam', function(e, riderID) {
		var $rider = $('.rider-list #rider-'+riderID);
console.log('FCupdateRiderOnTeam trigger');
console.log(riderID);
	});

	// when a rider is removed from the roster //
	$('body').on('FCenableRiderOnTeam', function(e, riderID) {
		var $rider = $('.rider-list #rider-'+riderID);
		var $wrap = $rider.find('.add-rider-wrap');
		var $name = $rider.find('.name');
		var riderName = $name.find('span').text();
		var addRiderBtn = '<a href="#" class="add-rider" data-id="'+riderID+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>'

		// fix name link issue //
		$name.html(riderName);

		// clear wrap and then add our add rider code //
		$wrap.html(addRiderBtn);
	});

});