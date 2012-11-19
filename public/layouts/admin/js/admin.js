/**
 * Check all checkboxes if checked main checkbox
 */
function observeCheckAll()
{
	var cb = jQuery('.cbgw-block .cbgw-header__ids input[type=checkbox]');
	cb.bind('change', function(){
		var cbs = jQuery(this).parents('table').find('.cbgw-column__ids input[type="checkbox"]');
		
		if (jQuery(this).attr('checked') == 'checked') {
			cbs.attr('checked', 'checked');
		} else {
			cbs.attr('checked', null);
		}
	});
}

function observeEnabledColumn()
{
	var cb = jQuery('.cbgw-block .cbgw-column__enabled input[type=checkbox]');
	cb.unbind('change').bind('change', function(e){
		e.preventDefault();
		var name = jQuery(this).attr('name');
		//jQuery(this).parent().find('input[name=' + name + ']')
		alert(name[0]);
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

/**
 * Preprocessing form data here
 */
function observeFormSubmit()
{
	jQuery('form').unbind('submit').bind('submit', function(){
		triggerSaveTinyMCE();
	});
}

/**
 * Observe submit buttons
 */
function observeGridFilters()
{
	jQuery('.cbgw-filter input').unbind('keyup mouseup').bind('keyup mouseup', function(){
		if (jQuery(this).data('timer')) {
			clearTimeout(jQuery(this).data('timer'));
		}
		
		if (!jQuery(this).data('val')) {
			jQuery(this).data('val', jQuery(this).val());
		}
		
		if (jQuery(this).val() != '') {
			var el  = jQuery(this);
			var t = setTimeout(function(){
				if (el.val() == el.data('val')) {
					return;
				}
				
				submitGridFilter(el);
			}, 3000);
			
			jQuery(this).data('timer', t);
		}
	});
	
	jQuery('.cbgw-filter select').unbind('change').bind('change', function(){
		submitGridFilter(jQuery(this));
	});
}

/**
 * Submit grid filter
 * 
 * @param e jQuery object
 */
function submitGridFilter(e)
{
	var filters = {};
	jQuery(e).parents('.cbgw-block').find('.cbgw-filter input, .cbgw-filter select').each(function(){
		filters[jQuery(this).attr('name')] = jQuery(this).val();
	});
	
	window.location.href = jQuery(e).parents('.cbgw-block').attr('action') + '?' + jQuery.param(filters);
}

/**
 * Observe events on dom tree loaded
 */
jQuery(document).ready(function(){
	observeFormSubmit();
	observeGridFilters();
	observeCheckAll();
	observeEnabledColumn();
});