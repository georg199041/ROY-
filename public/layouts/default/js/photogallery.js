

$(document).ready(function(){

	//slider 
	
	var visible = $(".slider_box").width();
	var itemWidth = 116;
	var max = $(".slider_item").length
	var length = max * itemWidth;
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
    	//console.log(slideBigImageNext+" -next");
    	//console.log(slideBigImagePrev+" -prev");
    	
	    	if($(this).hasClass("prevmini")){
	    		//console.log(222);
	    		//if(slideBigImagePrev<4){
	    			thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
	    			if(!$(".slider_item:first-child").hasClass("front-gallery-album-horizontal_carousel__min-foto_active")){
	    				$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
	    			}
	    			thisActive = thisActive.prev().addClass("front-gallery-album-horizontal_carousel__min-foto_active");
	    			
	    			curImage = thisActive.find("img").attr("src");
	    			//console.log(curImage);
		    		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		    		slideBigImagePrev++;
		    		//if(slideBigImageNext=4){slideBigImageNext=0; }
		    		//if(slideBigImagePrev=4){slideBigImagePrev=0;}
		    		
	    		//}
	    			
	    		
	    	}else{
	    		//console.log(111);
	    		//if(slideBigImageNext<4){
	    			thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
		    		if(!$(".slider_item:last-child").hasClass("front-gallery-album-horizontal_carousel__min-foto_active")){	
		    			$(".slider_item").removeClass("front-gallery-album-horizontal_carousel__min-foto_active");
		    		}
		    		thisActive.next().addClass("front-gallery-album-horizontal_carousel__min-foto_active");
		    		thisActive = $(".front-gallery-album-horizontal_carousel__min-foto_active");
		    		//if($(".slider_item").hasClass("front-gallery-album-horizontal_carousel__min-foto_active")){
//		    			console.log($(".slider_item").index(""));
		    		index = $(".front-gallery-album-horizontal_carousel__min-foto_active").attr('index');
	    			//}
		    		console.log(index);
		    		console.log($(".slider_item").length - 1);
		    		console.log(visible);
		    		var t = index + 1;
		    		console.log(t%5);
		    		if(index != $(".slider_item").length - 1 && !((index + 1)%5)){
		    			$(".slider_items").animate({"left": "-=" + visible}, 300);
		    		}	
		    		curImage = thisActive.find("img").attr("src");
		    		//console.log(curImage);
		    		$(".front-content-gallery-album-big-foto__photo").attr('src',curImage);
		    		slideBigImageNext++;
		    		
		    		//if(slideBigImagePrev=4){slideBigImagePrev=0;}
		    		//if(slideBigImageNext=4){slideBigImageNext=0; }
	    		//}
	    		
	    		
	    	}
    });

});


/*********************************************/
$(document).ready(function(){
	var PG_ITEM_WIDTH  = 116;
	var PG_FX_STEP_DUR = 400;
	var PG_PAGE_SIZE   = 5;
	var PG_LENGTH      = $('.front-photogallery-slider__item').length;
	var PG_PAGES       = Math.ceil(PG_LENGTH / PG_PAGE_SIZE);
	
	function photogallerySelectIcon(newIndex)
	{
		if (newIndex < 0 || newIndex >= PG_LENGTH) {
			$('.front-photogallery-slider__active-overlay').attr('inprogress', 'false');
			return;
		}
		
		var oldIndex = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
		var oldPage  = Math.floor(oldIndex / PG_PAGE_SIZE);
		var newPage  = Math.floor(newIndex / PG_PAGE_SIZE);
		
		if (oldPage == newPage) {
			photogalleryEffectIcon(newIndex);
		} else {
			photogalleryEffectPage(newPage);
			setTimeout(function(){
				photogalleryEffectIcon(newIndex);
			}, PG_FX_STEP_DUR / 10);
		}
	}
	
	function photogallerySelectPage(dir)
	{
		var oldIndex   = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
		var page       = Math.floor(oldIndex / PG_PAGE_SIZE);
		var pageIndex  = page * PG_PAGE_SIZE;
		
		if (dir == 'left') {
			//if (oldIndex == pageIndex) {
				page -= 1;
			//}
		} else {
			page += 1;
			if ((page * PG_PAGE_SIZE) >= PG_LENGTH) {
				photogallerySelectIcon(PG_LENGTH - 1);
				return;
			}
		}
		
		photogallerySelectIcon(page * PG_PAGE_SIZE);
	}
	
	function photogalleryEffectIcon(index)
	{
		var margin = PG_ITEM_WIDTH * index;
		$('.front-photogallery-slider__active-overlay').attr('index', index)
		$('.front-photogallery-slider__active-overlay').animate({
			"margin-left" : margin + "px"
		}, PG_FX_STEP_DUR, function(){
			var source = $('.front-photogallery-slider__width a[index=' + index + '] img');
			$('.front-photogallery-bigimage__container img').attr('src', source.attr('image'))
			$('.front-photogallery-bigimage__container img').attr('alt', source.attr('alt'))
			$('.front-photogallery-bigimage__container img').attr('title', source.attr('title'))
			$('.front-photogallery-bigimage__description').html(source.attr('description'));
			$('.front-photogallery-slider__active-overlay').attr('inprogress', 'false');
		});		
	}
	
	function photogalleryEffectPage(page)
	{
		var margin = page * PG_ITEM_WIDTH * PG_PAGE_SIZE;
		if (page * PG_PAGE_SIZE >= PG_LENGTH - PG_PAGE_SIZE) {
			margin = (PG_LENGTH - PG_PAGE_SIZE) * PG_ITEM_WIDTH;
		}
		
		$('.front-photogallery-slider__width').animate({
			"margin-left" : "-" + margin + "px"
		}, PG_FX_STEP_DUR);
	}
	
	function photogalleryControlsObserve()
	{
		$('.front-photogallery-slider__item a').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				photogallerySelectIcon(parseInt($(this).attr('index')));
			}
		});
		
		$('.front-photogallery-slider__btn').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				if ($(this).hasClass('front-photogallery-slider_btn-left')) {
					photogallerySelectPage('left');
				} else {
					photogallerySelectPage('right');
				}
			}
		});
		
		$('.front-photogallery-bigimage__btn').bind('click', function(e){
			e.preventDefault();
			var inprogress = $('.front-photogallery-slider__active-overlay').attr('inprogress');
			if (inprogress == 'false') {
				$('.front-photogallery-slider__active-overlay').attr('inprogress', 'true');
				var index = parseInt($('.front-photogallery-slider__active-overlay').attr('index'));
				
				if ($(this).hasClass('front-photogallery-bigimage_btn-left')) {
					photogallerySelectIcon(index - 1);
				} else {
					photogallerySelectIcon(index + 1);
				}
			}
		});
	}
	
	photogalleryControlsObserve();
});















