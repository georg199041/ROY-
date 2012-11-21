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
							<img alt="<?php echo $photo->getTitle(); ?>"
							     src="<?php echo $photo->getImage(); ?>"
							     image="<?php echo $photo->getImage(); ?>"
							     description="<?php echo $photo->getDescription(); ?>"
							     title="<?php echo $photo->getTitle(); ?>" />
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
				<img class="current" alt="<?php echo $current->getTitle(); ?>" src="<?php echo $current->getImage(); ?>" />
				<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-left"><span></span></a>
				<a href="#" class="front-photogallery-bigimage__btn front-photogallery-bigimage_btn-right"><span></span></a>
			</div>
			<div class="front-photogallery-bigimage__description">
				<?php echo $current->getDescription(); ?>
			</div>
		</div>
	</div>
	<?php
		echo Core::getBlock('comments/index/comments')->setCommentsTable('photogallery_albums')
		                                              ->setCommentsTableId($this->getAlbum()->getId());
	?>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu')->forseActivePageUrl('/photogallery.html'); ?>
</div>