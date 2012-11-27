/**
 * Grid script
 */
jQuery(document).ready(function(){
	/**
	 * Observe row checkbox clone state event
	 */
	jQuery('.cbgw-column__ids input[type="checkbox"]').on('master-changed', function(e, checked){
		jQuery(this).attr('checked', checked || null);
	});
	
	/**
	 * Observe master checbox change state event
	 */
	jQuery('.cbgw-header__ids input[type=checkbox]').on('change', function(){
		jQuery(this).parents('table').find('.cbgw-column__ids input[type="checkbox"]').trigger(
			'master-changed',
			jQuery(this).attr('checked')
		);
	});
	
	/**
	 * Observe row enabled checkbox event
	 */
	jQuery('.cbgw-column__enabled input[type=checkbox]').on('change', function(){
		var action = jQuery(this).attr('formaction');
		jQuery(this).parents('.cbgw-block').find('input, select').attr('disabled', true);
		window.location.href = action; //TODO
	});
	
	/**
	 * Observe row status radio event
	 */
	jQuery('.cbgw-column__status input[type=radio]').on('change', function(){
		var action = jQuery(this).attr('formaction') + '/value/' + jQuery(this).val();
		jQuery(this).parents('.cbgw-block').find('input, select').attr('disabled', true);
		window.location.href = action; //TODO
	});
	
	/**
	 * Observe filter (user-)submit event
	 */
	jQuery('.cbgw-block').on('submit-filter', function(){
		var f = jQuery(this).find('.cbgw-filter input, .cbgw-filter select');
		jQuery(this).find('.cbtw-block button, .cbgw-header__ids input, .cbgw-column__enabled input').attr('disabled', true);
		
		var q = '/';
		f.each(function(){
			q += jQuery(this).attr('name') + '/' + jQuery(this).val();
		});
		
		window.location.href = jQuery(this).attr('action') + q;// + '?' + f.serialize(); //TODO
	});
	
	/**
	 * Observe filter inputs auto submit
	 */
	jQuery('.cbgw-filter input').on('keyup mouseup', function(){
		if (jQuery(this).data('timer')) {
			clearTimeout(jQuery(this).data('timer'));
		}
		
		if (jQuery(this).val() != jQuery(this).attr('requested-value')) {
			var e = jQuery(this);
			var timer = setTimeout(function(){ e.trigger('submit-filter'); }, 3000);
			jQuery(this).data('timer', timer);
		}
	});
	
	/**
	 * Observe filter selects auto submit
	 */
	jQuery('.cbgw-filter select').on('change', function(){
		jQuery(this).trigger('submit-filter');
	});
});
