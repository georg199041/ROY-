/**
 * Frontpage full width slider
 */
$(document).ready(function(){
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
	
	$('.front-body-slider-buttons .slider_buttons').click(function(){
		var prev = $('.front-body-slider-color__item.active');
		var next;
		
		if ($(this).attr('id') == 'slider_back') {
			if (prev.prev().length > 0) {
				next = prev.prev();
			} else {
				next = $('.front-body-slider-color__item:last');
			}
		} else if ($(this).attr('id') == 'slider_next') {
			if (prev.next().length > 0) {
				next = prev.next();
			} else {
				next = $('.front-body-slider-color__item:first');
			}
		}
		console.log(prev.prev().length);
		
		if (next) {
			next.css({'zIndex': '2', 'opacity': '1'});
			prev.stop().animate({'opacity': '0'}, 300, function(){
				next.css({'z-index': '3'}).addClass('active');
				$(this).css({'z-index': '1', 'opacity': '1'}).removeClass('active');
				
				$(".front-body-slider-blackwhite-left").css({"backgroundImage": 'url("' + next.find('img').attr('bg_left') + '")'});
				$(".front-body-slider-blackwhite-right").css({"backgroundImage": 'url("' + next.find('img').attr('bg_right') + '")'});
			});
		}
	});
});

