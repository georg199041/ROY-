
<div class="front-body-content">
	<h1><?php echo $this->getAlbum()->getTitle(); ?></h1>
	<?php echo $this->getAlbum()->getDescription(); ?>
	<?php $current = $this->getAlbumPhotos()->current(); ?>
	
	<div class="front-content-gallery-album">
		<div class="front-content-gallery-album-horizontal_carousel slider_box">
			
			<ul class="front-content-gallery-album-horizontal_carousel__foto-slide slider_items">
				<?php //active class: front-gallery-album-horizontal_carousel__min-foto_active ?>
				<?php $i=0; ?>
				<?php foreach ($this->getAlbumPhotos() as $photo): ?>
					<li class="front-content-gallery-album-horizontal_carousel__min-foto slider_item" index="<?php echo $i ?>">
						<a class="front-content-gallery-album-horizontal_carousel__open-photo" href="#">
							<img alt="<?php echo $photo->getTitle(); ?>" src="<?php echo $photo->getImage(); ?>" />
						</a>
					</li>
				<?php $i++; ?>	
				<?php endforeach; ?>
			</ul>
			<input type="button" class="front-content-gallery-album-min-foto__arrow_left prevmini" />
			<input type="button" class="front-content-gallery-album-min-foto__arrow_right nextmini"/>
		</div>

		<div class="front-content-gallery-album-big-foto">
			<a class="front-content-gallery-album-big-foto__arrow_left prevmini" href="#"></a>
			<img class="front-content-gallery-album-big-foto__photo" alt="<?php echo $current->getTitle(); ?>" src="<?php echo $current->getImage(); ?>" />
			<a class="front-content-gallery-album-big-foto__arrow_right nextmini" href="#"></a>
		</div>
		<?php echo $current->getDescription(); ?>
	</div>
	<?php
		echo Core::getBlock('comments/index/comments')->setCommentsTable('photogallery_albums')
		                                              ->setCommentsTableId($this->getAlbum()->getId());
	?>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu')->forseActivePageUrl('/photogallery'); ?>
</div>