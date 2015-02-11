jQuery(document).ready(function($) {
	var gets=getUrlVars();
	if (gets['page']) {
		var page=gets['page'];
		var prePage='admin.php?page=';
		var fullPage=prePage+page;
		if (page=='top25-week-view') {
			$('#toplevel_page_top25-admin .wp-submenu ul li').each(function() {
				var href=$(this).children().attr('href');
				console.log(href);
				//console.log(fullPage);
				if (href==prePage+'top25-week') {
					$(this).addClass='active';
				}
			});
		}
	}
});

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}