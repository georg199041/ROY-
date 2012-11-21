<div class="front-body-content">
	<h1>Галерея</h1>
    <div class="front-content-gallery">
    	<?php foreach ($this->getAlbums() as $album): ?>
    		<?php
    			$url = $this->url(array(
					'album_alias' => $album->getAlias(),
					'module'      => 'photogallery',
					'controller'  => 'index',
    				'action'      => 'album'
				), 'photogallery_album', true);
			?>
	    	<div class="front-content-gallery-photos">
	            <a class="front-content-gallery__unit-link" title="<?php echo $album->getTitle(); ?>" href="<?php echo $url; ?>">
	                <img alt="<?php echo $album->getTitle(); ?>" src="<?php echo $album->getImage(); ?>"  />
	            </a>
	            <a class="front-content-gallery__description" title="<?php echo $album->getTitle(); ?>" href="<?php echo $url; ?>">
	            	<?php echo $album->getTitle(); ?>
	            </a>
	        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>