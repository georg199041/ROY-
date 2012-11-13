//SCHEMA INDEX PAGE

$(document).ready(function(){	
	$(".front-body-schema__item").hover(function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeOut("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeIn("fast");
		$(this).find(".front-body-schema__item-introtext").show();
		$(this).find(".front-body-schema__item-background-wrap").animate({"width":"471px"}, 200);
		$(this).find(".front-body-schema__item-title").css({"color":"#FFF","marginTop":"0px"});
	},function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeIn("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeOut("fast");
		$(this).find(".front-body-schema__item-introtext").hide();
		$(this).find(".front-body-schema__item-background-wrap").animate({"width":"0"}, 200);
		$(this).find(".front-body-schema__item-title").css({"color":"#FF8053","marginTop":"40px"});
	});
});