/**
 * Toolbar messenger script
 */
jQuery(document).ready(function(){
	var MSG_FX_STEP_DUR = 200;
	var MSG_FX_DELAY    = 4000;
	
	/**
	 * Observe show/hide all messages event
	 */
	jQuery('.admin-info__button').live('click', function(event){
		event.preventDefault();
		jQuery('.admin-info .message').removeClass('message_unreaded');
		if (jQuery(this).attr('displayed') != 'true') {
			jQuery('.admin-info .message').css({
				'opacity': '0',
				'display': 'block'
			}).stop(true, true).animate({
				'opacity': '1'
			}, function(){
				jQuery('.admin-info__button').attr('displayed', 'true');
			});
		} else {
			jQuery('.admin-info .message').stop(true, true).animate({
				'opacity': '0'
			}, function(){
				jQuery(this).css({
					'opacity': '0',
					'display': 'block'
				});
				jQuery('.admin-info__button').attr('displayed', 'false');
			});
		}
	});
	
	/**
	 * Observe messages autohide event
	 */
	jQuery('.admin-info .messages').live('message-auto-close', function(){
		$this = jQuery(this);
		
			setTimeout(function(){
				if ($this.find('.message_unreaded').length) {
					$this.find('.message_unreaded:first').trigger('message-close');
				}	
				$this.trigger('message-auto-close');
			}, MSG_FX_DELAY);
		
			
	});
	
	/**
	 * Observe message close event
	 */
	jQuery('.admin-info .message').live('message-close', function(){
		jQuery(this).removeClass('message_unreaded');
		jQuery(this).animate({
			'opacity': '0'
		}, MSG_FX_STEP_DUR, function(){
			jQuery(this).animate({
				'height'         : '0',
				'padding-top'    : '0',
				'padding-bottom' : '0',
				'border-width'   : '0',
				'margin'         : '0'
			}, MSG_FX_STEP_DUR, function(){
				jQuery(this).css({
					'display'        : 'none',
					'height'         : 'auto',
					'opacity'        : '1',
					'padding-top'    : '7px',
					'padding-bottom' : '7px',
					'border-width'   : '1px',
					'margin'         : '5px'
				});
			});
		});
	});
	
	/**
	 * Observe message close event
	 */
	jQuery('.admin-info .message a.close').live('click', function(event){
		event.preventDefault();
		jQuery(this).parents('.message').trigger('message-close');
	});
	
	/**
	 * Run autohide timer
	 */
	jQuery('.admin-info .messages').trigger('message-auto-close');
});