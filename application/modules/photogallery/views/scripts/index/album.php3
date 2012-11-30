<div class="front-body-content">
	<h1><?php echo $this->getAlbum()->getTitle(); ?></h1>
	<?php echo $this->getAlbum()->getDescription(); ?>
	<?php $current = $this->getAlbumPhotos()->current(); ?>
	
	<div class="front-content-gallery-album">
		<div class="front-photogallery-slider__icons">
			<ul class="front-photogallery-slider__width" style="margin-left: 0; width:<?php echo (int) $this->getAlbumPhotos()->count() * 116; ?>px">
				<li class="front-photogallery-slider__active-overlay" style="margin-left: 0;" index="0" inprogress="false"></li>
				<?php $i = 0; ?>
				<?php foreach ($this->getAlbumPhotos() as $photo): ?>
					<li class="front-photogallery-slider__item front-photogallery-slider_item-active">
						<a href="#" index="<?php echo $i; ?>">
							<!-- <img alt="<?php /*echo $photo->getTitle(); ?>"
							     src="<?php echo $photo->getImage(); ?>"
							     image="<?php echo $photo->getImage(); ?>"
							     description="<?php echo $photo->getDescription(); ?>"
							     title="<?php echo $photo->getTitle(); */?>" /> -->
							<?php if ($photo->getImage()): ?>
					    	<?php
					    		$noImage = false;
					    		try {
									$bigImage = "/". $this->image($photo->getImage())->resizeToWidth(570)->getPath();

					    			echo $this->image($photo->getImage(), array(
					    				"image" => $bigImage,
										"description" => $photo->getDescription(),
										"title" => $photo->getTitle(),
					    				"alt"   => $photo->getTitle()
					    			))->resizeToCrop(104, 70);
									
					    		} catch (Exception $e) {
									$noImage = true;
								}
					    	?>
					        <?php endif; ?>     
						</a>
					</li>
					<?php $i++; ?>
				<?php endforeach; ?>
			</ul>
			<a href="#" class="front-photogallery-slider__btn front-photogallery-slider_btn-left"></a>
			<a href="#" class="front-photogallery-slider__btn front-photogallery-slider_btn-right"></a>
		</div>
		<div class="front-photogallery__bigimage">
			<div class="front-photogallery-bigimage__container">
				<!-- <img class="current" alt="<?php /*echo $current->getTitle();*/ ?>" src="<?php /*echo $current->getImage();*/ ?>" /> -->
				<?php if ($current->getImage()): ?>
		    	<?php
		    		$noImage = false;
		    		try {
		    			echo $this->image($current->getImage(), array(
		    				"class" => "current",
		    				"alt"   => $current->getTitle()
		    			))->resizeToWidth(570);
		    		} catch (Exception $e) {
						$noImage = true;
					}
		    	?>
		        <?php endif; ?>
				<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-left"><span></span></a>
				<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-right"><span></span></a>
			</div>
			<div class="front-photogallery-bigimage__description">
				<?php echo $current->getDescription(); ?>
			</div>
		</div>
	</div>
	<?php
		$addComment = Core::getBlock('comments/index/add-comment');
		$addComment->setCommentsTable('photogallery_albums');
		$addComment->setCommentsTableId($this->getAlbum()->getId());
		$addComment->setBackUrl($_SERVER['REQUEST_URI']);
		
		$comments = Core::getBlock('comments/index/comments');
		$comments->setCommentsTable('photogallery_albums');
		$comments->setCommentsTableId($this->getAlbum()->getId());
		
		echo $comments;
	?>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu')->forseActivePageUrl('/photogallery.html'); ?>
</div>