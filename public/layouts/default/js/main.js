//SCHEMA INDEX PAGE

$(document).ready(function(){	
	$(".front-body-schema__item").hover(function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeOut("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeIn("fast");
		$(this).find(".front-body-schema__item-introtext").show();
		$(this).find(".front-body-schema__item-background-wrap").animate({"width":"471px"}, 200);
		$(this).find(".front-body-schema__item-title").css({"color":"#FFF","marginTop":"0px"});
		$(this).find(".front-body-schema__item-introtext").show();
		$(this).find(".front-body-schema__item-titlebox").addClass("front-body-schema__item-titlebox_afterhover").removeClass("front-body-schema__item-titlebox");
	},function(){
		$(this).stop();
		$(this).find(".front-body-schema__item-image-beforehover").fadeIn("fast");
		$(this).find(".front-body-schema__item-image-afterhover").fadeOut("fast");
		$(this).find(".front-body-schema__item-introtext").hide();
		$(this).find(".front-body-schema__item-background-wrap").animate({"width":"0"}, 200);
		$(this).find(".front-body-schema__item-title").css({"color":"#FF8053","marginTop":"40px"});
		$(this).find(".front-body-schema__item-titlebox_afterhover").addClass("front-body-schema__item-titlebox").removeClass("front-body-schema__item-titlebox_afterhover");

	});
});