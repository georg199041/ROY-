

$(document).ready(function(){
	
	//SCHEMA INDEX PAGE
	
	$(".front-body-schema__item-image").css({
		"width"   : "86px",
		"height"  : "100px",
	});
	
	//MENU HOVERS
	$(".front-header-menu__item-href").hover(function(){
	
	},function(){
		
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
		
		$(this).find(".front-body-schema__item-list-dots li").stop().animate({"height":"4px"}, 200);
		$(this).find(".front-body-schema__item-image_beforehover").stop().animate($.extend(css, {"opacity":"0"}), 300);
		$(this).find(".front-body-schema__item-image_afterhover").stop().animate($.extend(css, {"opacity":"1"}), 300);
		
		$(this).find(".front-body-schema__item-introtext").show();
		$(this).find(".front-body-schema__item-background-wrap").stop().delay(300).animate({"width":"100%"}, 300);
		
	},function(){
		
		$(this).find(".front-body-schema__item-titlebox").removeClass("front-body-schema__item_titlebox-hover");
		
		
		$(this).find(".front-body-schema__item-list-dots li").stop().animate({"height":"11px","":""}, 300);
		var css = $(this).find(".front-body-schema__item-image").data("css");
		$(this).find(".front-body-schema__item-image_beforehover").stop().animate($.extend(css, {"opacity":"1"}), 300);
		$(this).find(".front-body-schema__item-image_afterhover").stop().animate($.extend(css, {"opacity":"0"}), 300);
		

		$(this).find(".front-body-schema__item-introtext").hide();
		$(this).find(".front-body-schema__item-background-wrap").stop().animate({"width":"0"}, 100);
		

	});
	
	
	//MAIN PAGE SLIDER
	$("#slider_back").hover(function(){
		$(this).css({
			"background":"url(/layouts/default/images/slider_arrows.png) no-repeat",
			"background-position":"20px 40px"
		})
	},function(){
		$(this).css({"background":"transparent"});
	});
	$("#slider_next").hover(function(){
		$(this).css({
			"background":"url(/layouts/default/images/slider_arrows.png) no-repeat",
			"background-position":"-108px 40px "
		})
	},function(){
		$(this).css({"background":"transparent"});
	});
	
	
	
	$(".front-body-slider-color-wrap .front-body-slider-color__item:first-child").addClass("active");
	
	$('.slider_buttons').click(function() {	
		var button = $(this).attr('id');
		var current_image = $('.front-body-slider-color-wrap .front-body-slider-color__item.active');
		var cur_left_bg;
		var cur_right_bg;
		var next;
		
		
		if (button == 'slider_back') {
			console.log(button);
			next = ($('.front-body-slider-color-wrap .front-body-slider-color__item.active').prev().length > 0) ?
				$('.front-body-slider-color-wrap .front-body-slider-color__item.active').prev() :
				$('.front-body-slider-color-wrap .front-body-slider-color__item:last');
				
				
		}else {
			
			next = ($('.front-body-slider-color-wrap .front-body-slider-color__item.active').next().length > 0) ?
				$('.front-body-slider-color-wrap .front-body-slider-color__item.active').next() :
				$('.front-body-slider-color-wrap .front-body-slider-color__item:first');
				
		} 
		
		
		next.css('z-index', 2).show();				
		current_image.fadeOut(300, function() {
			$(this).css('z-index', 1).removeClass('active');
			next.css('z-index', 3).addClass('active');
			cur_left_bg = $('.front-body-slider-color-wrap .front-body-slider-color__item.active img').attr("bg_left");
			cur_right_bg = $('.front-body-slider-color-wrap .front-body-slider-color__item.active img').attr("bg_right");
			$(".front-body-slider-blackwhite-left").css("background", "url(" +cur_left_bg+");" );
			$(".front-body-slider-blackwhite-right").css("background", "url(" +cur_right_bg+");" );
		});
	});	
		
});

