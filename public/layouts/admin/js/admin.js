/**
 * Send sync or async request
 * 
 * @param url     string
 * @param options object json
 */
function sendRequest(url, options)
{
	if (options && options.async == false) {
		window.location.href = url;
		return;
	}
	
	options.url = url;
	jQuery.ajax(options);
}

/**
 * call server action
 * 
 * @param action   string|Element|jQuery
 * @param elements array|jQuery|string
 */
function callAction(action, elements)
{
	if (action instanceof Element) {
		action = jQuery(action).attr('formaction');
	} else if (action instanceof jQuery) {
		action = action.attr('formaction');
	}
	
	if (typeof action != 'string' || action == '') {
		throw "Action must be a non empty string or DOM element or jQuery element with non empty formaction attribute";
	}
	
	if (!elements) {
		elements = '';
	}
	
	if (typeof elements == 'string') {
		elements = jQuery(elements).serialize();
	} else if (elements instanceof jQuery) {
		elements = elements.serialize();
	} else if (elements instanceof Array) {
		elements = jQuery.param(elements);
	}
	
	if (typeof elements != 'string') {
		throw "Elements must be passed as string jQuery selector or jQuery collection or array of params for $.param() method";
	}
	
	sendRequest(action + (elements ? '?' : '') + elements, {async:false});
}

/**
 * Observe enabled checkboxes in grid
 */
function observeEnabledCheckbox()
{
	jQuery('.cbgw-column__enabled input').unbind('click').bind('click', function(event){
		callAction(jQuery(this).attr('formaction'));
	});
}



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
	observeEnabledCheckbox();
});