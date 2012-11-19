

$(document).ready(function(){

	//slider 
	
	var visible = $(".slider_box").width();
	var itemWidth = 116;
	var length = $(".slider_item").length * itemWidth;
	$(".slider_item:first-child").addClass("front-gallery-album-horizontal_carousel__min-foto_active");
	var i=580;
	var ramka=1;
	var count = length/itemWidth;
	var grow;
	var curImage;
	var slideBigImagePrev=0;
	var slideBigImageNext=0;
	var thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
	
	curImage = $(".front-gallery-album-horizontal_carousel__min-foto_active img").attr("src");
	$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
	
	$(".front-content-gallery-album-horizontal_carousel__open-photo").click(function(event){
		event.preventDefault();
		$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
		$(this).parent().addClass("front-gallery-album-horizontal_carousel__min-foto_active");
		curImage = $(this).find("img").attr("src");
		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		
	});
	
	$(".slider_box input").click(function(event){
		//console.log("click");
		//event.preventDefault();
		
		$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
		var left = $(".slider_items").position().left;
		slideBigImagePrev = 0;
		slideBigImageNext = 0;
		
		if($(this).hasClass("prevmini")){
			
			if(left!=0){	
				if(i-visible>580){
					$(".slider_items").animate({"left": "+=" + visible}, 300);
					i-=580;	
					ramka-=5;
					$(".slider_item:nth-child("+ramka+")").addClass("front-gallery-album-horizontal_carousel__min-foto_active");
				}else{
					$(".slider_items").animate({"left": "+=" + (i-visible)}, 300);
					grow = (i-visible)/itemWidth;
					i-=i-visible;	
					//console.log(grow);
					ramka-=grow;
					$(".slider_item:nth-child("+ramka+")").addClass("front-gallery-album-horizontal_carousel__min-foto_active");
					
				}
				
			
			}
			
		}else{
			
			if(length-i>580){
				$(".slider_items").animate({"left": "-=" + visible}, 300);
				i+=580;
				ramka+=5;
				$(".slider_item:nth-child("+ramka+")").addClass("front-gallery-album-horizontal_carousel__min-foto_active");
			}else{
				$(".slider_items").animate({"left": "-=" + (length-i)}, 300);
				grow = (length-i)/itemWidth;
				i+=length-i;
				
				//console.log(grow);
				ramka+=grow;
				$(".slider_item:nth-child("+ramka+")").addClass("front-gallery-album-horizontal_carousel__min-foto_active");
			}
			
			
			
		}
		//console.log(ramka);
		curImage = $(".front-gallery-album-horizontal_carousel__min-foto_active img").attr("src");
		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		
	});
	
	
    
    $(".front-content-gallery-album-big-foto a").click(function(event){
    	event.preventDefault();
    	console.log(slideBigImageNext+" -next");
    	console.log(slideBigImagePrev+" -prev");
	    	if($(this).hasClass("prevmini")){
	    		//console.log(222);
	    		if(slideBigImagePrev<4){
	    			thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
	    			if(!$(".slider_item:first-child").hasClass("front-gallery-album-horizontal_carousel__min-foto_active")){
	    				$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
	    			}
	    			thisActive = thisActive.prev().addClass("front-gallery-album-horizontal_carousel__min-foto_active");
	    			curImage = thisActive.find("img").attr("src");
	    			console.log(curImage);
		    		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		    		slideBigImagePrev++;
		    		if(slideBigImageNext=4){slideBigImageNext=0;}
		    		
	    		}
	    			
	    		
	    	}else{
	    		//console.log(111);
	    		if(slideBigImageNext<4){
	    			thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
		    		if(!$(".slider_item:last-child").hasClass("front-gallery-album-horizontal_carousel__min-foto_active")){	
		    			$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
		    		}
		    		thisActive.next().addClass("front-gallery-album-horizontal_carousel__min-foto_active");
		    		thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
		    		curImage = thisActive.find("img").attr("src");
		    		console.log(curImage);
		    		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		    		slideBigImageNext++;
		    		if(slideBigImagePrev=4){slideBigImagePrev=0;}
		    		
	    		}
	    		
	    		
	    	}
    });

});

