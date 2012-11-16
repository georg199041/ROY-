

$(document).ready(function(){

	//slider 
	
	var visible = $(".slider_box").width();
	var itemWidth = $(".slider_item").width();
	var length = $(".slider_item").length * itemWidth;
	$(".slider_box a").click(function(){
		
		var left = $(".slider_items").position().left;
		
		if($(this).hasClass("prevmini")){
			if(left!=0){	
				$(".slider_items").animate({"left": "+=" + visible}, 300);
			}
		}else{
			
			$(".slider_items").animate({"left": "-=" + visible}, 300);
			console.log(left);
			console.log(length);
		}
			
		
		
	});
    
    

});

