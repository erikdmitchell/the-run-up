jQuery(document).ready(function($) {
	//console.log('voteJS');
	var usedIDs=[];
	var i=0;
	$('#top25 select').change(function() {
		//console.log('change');
		var boxID=$(this).attr('id');
		var boxValue=$('select#'+boxID).val();
		// search through array to see if this box has a value //
		//console.log('usedIDs: '+usedIDs);
		$.each(usedIDs, function(k,v) {
			var id=this[0];
			var rider=this[1];
			//console.log(k+' '+id+' '+rider);
			if (id==boxID) {
				// remove from array and old name becomes active //
				$('#top25 select').each(function() {
					var thisID=$(this).attr('id');
					// loop through each option and add match //
					$('#'+thisID+' option').each(function() {
						if ($(this).val()==rider) {
							$(this).removeAttr('disabled');
						}
					});
				}); // end select each function //
				usedIDs.splice(k,1); // remove from array //
			}
		});
		
		// add id and value to primary array //
		usedIDs[i]=new Array(2);
		usedIDs[i][0]=boxID;
		usedIDs[i][1]=boxValue;
		
		// remove this value from all other boxes //
		$('#top25 select').each(function() {
			//console.log('each');
			if ($(this).attr('id')!=boxID) {
				var thisID=$(this).attr('id');
				// loop through each option and remove match //
				$('#'+thisID+' option').each(function() {
					if ($(this).val()==boxValue) {
						$(this).attr('disabled','disabled');
					}
				});
			} // end if matching box ids //
		}); // end select each function //
		//console.log(usedIDs);
		i++;
	}); // end change function //
});