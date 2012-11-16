

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
		console.log(image);
		console.log(title);
		console.log(description);
		
		
	});
	
	//NAVI CLICK
	$(".front-content-arrow_right a").click(function(event){
		
		event.preventDefault();
		
		if($(".front-content-arrow_right a").hasClass('back')){
			
		}else{
			
		}	
		
	});
	
});