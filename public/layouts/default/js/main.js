//SCHEMA INDEX PAGE

$(document).ready(function(){
//	$(".front-body-schema__item-image-beforehover").css({
//		"width"   : "86px",
//		"height"  : "100px",
//		"opacity" : "1",
//		"display" : "block",
//	});
	
	$(".front-body-schema__item-image").css({
		"width"   : "86px",
		"height"  : "100px",
	});
	
	$(".front-body-schema__item").hover(function(){
		
		$(this).find(".front-body-schema__item-titlebox").addClass("front-body-schema__item_titlebox-hover");
		
		//save old margins in data
		$(this).find(".front-body-schema__item-image").data(
			"css", 
			{
				"margin-left"   : $(this).find(".front-body-schema__item-image").css("margin-left"),
				"margin-right"  : $(this).find(".front-body-schema__item-image").css("margin-right"),
				"margin-top"    : $(this).find(".front-body-schema__item-image").css("margin-top"),
				"margin-bottom" : $(this).find(".front-body-schema__item-image").css("margin-bottom"),
				"width"   : "86px",
				"height"  : "100px",
			}
		);
		
		var css = {
			"width" :"130px",
			"height":"150px",
			"margin": "5px 7px 0",
		}
		
		$(this).find(".front-body-schema__item-image_beforehover").stop().animate($.extend(css, {"opacity":"0"}), 1000);
		$(this).find(".front-body-schema__item-image_afterhover").stop().animate($.extend(css, {"opacity":"1"}), 1000);
		
		$(this).find(".front-body-schema__item-title").css({"color":"#FFF"});
		$(this).find(".front-body-schema__item-introtext").show();
		$(this).find(".front-body-schema__item-background-wrap").animate({"width":"100%"});
		
	},function(){
		
		//$(this).find(".front-body-schema__item-titlebox").removeClass("front-body-schema__item_titlebox-hover");
		
		//$(this).find(".front-body-schema__item-image").stop().animate(css, 1000);
		//var css = $(this).find(".front-body-schema__item-image").data("css");
		//$(this).find(".front-body-schema__item-image_beforehover").stop().animate($.extend(css, {"opacity":"1"}), 1000);
		//$(this).find(".front-body-schema__item-image_afterhover").stop().animate($.extend(css, {"opacity":"0"}), 1000);
		
		//$(this).find(".front-body-schema__item-image_beforehover").stop().animate({"opacity":"1"}, 1000);
		//$(this).find(".front-body-schema__item-image_afterhover").stop().animate({"opacity":"0"}, 1000);

		//$(this).find(".front-body-schema__item-introtext").hide();
		//$(this).find(".front-body-schema__item-background-wrap").animate({"width":"0"}, 200);
		

	});
});