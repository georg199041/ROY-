//SCHEMA INDEX PAGE

$(document).ready(function(){	

	$(".front-body-schema__item").hover(function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeOut("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeIn("fast");
	},function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeIn("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeOut("fast");
	});
});