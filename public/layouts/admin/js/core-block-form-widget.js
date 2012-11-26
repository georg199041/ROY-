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
	
	jQuery(".cbfw-tag__image input").qtip({
		content: '',
		position: { target: 'mouse' },
		api: {
	        onRender:function() {
	           //alert('test');
	           this.updateContent('<img class="img-polaroid" style="display: block; width:230px;" src="' + this.elements.target.val() + '"/>');
	        }
	    },
	    style: {
	    	border: 'none',
	    	width: 250,
	    	overflow: 'visible',
	    	background: 'none'
	    }
	});
	
	/*jQuery(".cbfw-tag__image input").qtip({
	   content: '1',
	   onRender: function(){
		   console.log(123);
	   },
	   style: { 
	      border: {
	         width: 3,
	         radius: 8,
	         color: '#6699CC'
	      },
	      width: 200
	}  });*/
});