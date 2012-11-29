/**
 * Recomendations fx events
 */
$(document).ready(function(){
	
	//RECOMMENDATIONS
	
	//MINIATURES CLICK
	$(".front-content-carousel__preview-picture a").click(function(event){
		
		event.preventDefault();
		
		var image = $(this).attr("image");
		
		var title = $(this).attr("title");
		
		var description = $(this).attr("description");
		
		$("#recommend-image").attr("src", image);
		$("#recommend-title").html(title);
		$("#recommend-description").html(description);
		
		
		
	});
	//NAVI CLICK
	
	var item_height = 130;
	var step_size   = 4;
	var length      = $('.front-content-carousel__preview-picture').length;
	var move = step_size*item_height;
	
	
	
	
	
//	$(".front-content-arrow_right > a").click(function(event){
//		
//		event.preventDefault();
//		
//		var removed = $(".front-content-carousel ul").position().top;
//		if($(this).hasClass('back')){
//			if(move>=0){
//				$(".front-content-carousel ul").css({"top": "-=" + move});
//				removed = $(".front-content-carousel ul").position().top;
//			}else{
//				removed = $(".front-content-carousel ul").position().top;
//				console.log(length-removed)
//				$(".front-content-carousel ul").css({"top": "-=" + item_height});
//			}
//		}else{
//			if(move<=0){
//				$(".front-content-carousel ul").css({"top": "+=" + move});
//				removed = $(".front-content-carousel ul").position().top;
//			}else{
//				removed = $(".front-content-carousel ul").position().top;
//				console.log(length-removed)
//				$(".front-content-carousel ul").css({"top": "+=" + item_height});
//			}
//		}	
//		
//	});
	

});