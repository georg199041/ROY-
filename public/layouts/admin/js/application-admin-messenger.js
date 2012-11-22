// Messenger events
jQuery(document).ready(function(){
	jQuery('.admin-info .message').on('click', 'a.close', function(event){
		event.preventDefault();
		jQuery(this).parents('.message').hide();
	});
});