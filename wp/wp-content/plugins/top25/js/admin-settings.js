jQuery(document).ready(function($) {
	$('.open-close').click(function(e) {
		e.preventDefault();
		var id=$(this).parent().attr('id');	
		if ($(this).html()=='Close') {
			$(this).html('Open');
			$('ul#'+id).hide();
		} else {
			$(this).html('Close');
			$('ul#'+id).show();
		}
	});
	
});