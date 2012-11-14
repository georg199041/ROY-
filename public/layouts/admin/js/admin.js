/**
 * Check all checkboxes if checked main checkbox
 */
function checkAllObserve()
{
	var cb = $('.cbgw-block .cbgw-header-ids input[type=checkbox]');
	cb.bind('change', function(){
		var cbs = $(this).parents('.cbgw-block')
		                 .find('.cbgw-column-ids input[type="checkbox"]');
		
		if ($(this).attr('checked') == 'checked') {
			cbs.attr('checked', 'checked');
		} else {
			cbs.attr('checked', null);
		}
	});
}

/**
 * Observe grid show button handle
 */
function showSelectedObserve()
{
	var elms = $('.cbtw-button-show a, .cbtw-button-hide a, .cbtw-button-move a, .cbtw-button-copy a, .cbtw-button-delete a');
	elms.unbind('click').bind('click', function(e){
		e.preventDefault();
		var cbs = $(this).parents('.cbgw-block')
		                 .find('.cbgw-column-ids input[type="checkbox"]:checked');
		
		var post = [];
		cbs.each(function(){
			var name = $(this).attr('name');
			name = name.substr(0, name.indexOf(']'));
			name = name.substr(name.indexOf('[') + 1)
			post.push('ids[]=' + name);
		});
		
		window.location.href= $(this).attr('href') + (post.length > 0 ? '?' + post.join('&') : '');
	});
}

/**
 * Prepare tinimce editors before requests
 */
function triggerSaveTinyMCE() {
	if (tinyMCE) {
		for (var i in tinyMCE.editors) {
			tinyMCE.editors[i].save();
		}
	}
}

$(document).ajaxSend(function(e, jqxhr, settings) {
	triggerSaveTinyMCE();
});

$(document).ready(function(){
	checkAllObserve();
	showSelectedObserve();
	triggerSaveTinyMCE();
});