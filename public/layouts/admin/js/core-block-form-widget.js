/**
 * Form script
 */
jQuery(document).ready(function(){
	/**
	 * Add decorate validation required class
	 */
	jQuery('.cbfw-element').addClass('control-group');
	jQuery('.cbfw-element').each(function(){
		if (jQuery(this).hasClass('cbfw-element_error')) {
			jQuery(this).addClass('error');
		}
	});
	
	/**
	 * Validation progress
	 */
	jQuery('.cbfw-block form').on('submit', function(event){
		jQuery(this).find('button').attr('disabled', true);
	});

	/**
	 * Override submit buttons for old browsers handle
	 */
	jQuery('button[name=save], button[name=back], button[name=cancel]').on('click', function(event){
		event.preventDefault();
		jQuery(this).parents('form').attr('action', jQuery(this).attr('formaction')).trigger('submit');
	});
	
	/**
	 * test
	 */
	jQuery('.cbfw-tag-addbtn-image__select').on('click', function(){
		alert('select');
	});
});