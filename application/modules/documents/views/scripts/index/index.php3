<div class="front-body-content">
    <h1>Документы</h1>
    <?php $current = $this->getDocumentsPosts()->current(); ?>
	    
	    <div class="front-body-content-picture-big">
	        <img id="recommend-image" alt="<?php echo $this->escape($current->getTitle()); ?>" src="<?php echo $current->getImage(); ?>" />
	        <h2 id="recommend-title"><?php echo $current->getTitle(); ?></h2>
	        <span id="recommend-description"><?php echo $current->getDescription(); ?></span>
	    </div>
	    
    <div class="front-content-arrow_right">
        <a class="front-content-carousel__arrow_top back" href="#"></a>
        <div class="front-content-carousel">
            <ul style="height: <?php echo $this->getDocumentsPosts()->count() * 129; ?>px">
            	<?php $i = 0; ?>
            	<?php foreach ($this->getDocumentsPosts() as $post): ?>
            		<?php 
            			$addClass = 'front-content-carousel__preview-picture_right';
            			if (!($i % 2)) {
							$addClass = 'front-content-carousel__preview-picture_left';
						}
            		?>
	                <li class="front-content-carousel__preview-picture <?php echo $addClass; ?>">
	                    <a href="#" title="<?php echo $this->escape($post->getTitle()); ?>" description="<?php echo $this->escape($post->getDescription()); ?>" image="<?php echo $post->getImage(); ?>">
	                        <span class="front-carousel__preview-mask"></span>
	                        <img alt="<?php echo $this->escape($post->getTitle()); ?>" src="<?php echo $post->getImage(); ?>" />
	                    </a>
	                </li>
	                <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <a class="front-content-carousel__arrow_bottom next" href="#"></a>
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>