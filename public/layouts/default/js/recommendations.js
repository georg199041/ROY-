

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
	
	var PG_ITEM  	   = 130;
	var PG_FX_STEP_DUR = 400;
	var PG_PAGE_SIZE   = 4;
	var PG_LENGTH      = $('.front-content-carousel__preview-picture').length;
	
	
	$(".front-content-arrow_right>a").click(function(event){
		
		event.preventDefault();
		if($(".front-content-arrow_right>a").hasClass('back')){
			
		}else{
			
		}	
		
	});
	
	
	
	
	
});