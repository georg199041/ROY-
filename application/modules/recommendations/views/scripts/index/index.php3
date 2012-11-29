<div class="front-body-content">
    <h1>Рекомендации</h1>
    <?php $current = $this->getRecommendationsPosts()->current(); ?>
    <div class="front-body-content-picture-big">
        <?php if ($current->getImage()): ?>
    	<?php
    		$noImage = false;
    		try {
    			echo $this->image($current->getImage(), array(
    				"id" => "recommend-image",
    				"alt"   => $this->escape($current->getTitle())
    			))->resizeToWidth(423);
    		} catch (Exception $e) {
				$noImage = true;
			}
    	?>
        <?php endif; ?>
        <h2 id="recommend-title"><?php echo $current->getTitle(); ?></h2>
        <span id="recommend-description"><?php echo $current->getDescription(); ?></span>
    </div>
    <div class="front-content-arrow_right">
		<div class="front-doc__slider">
			<a class="front-doc-slider__button front-doc-slider_button-back" href="#"></a>
			<div class="front-doc-slider__overflow">
				<ul style="height: <?php echo (int) /*$this->getRecommendationsPosts()->count()*/ (4 * 128) - 10; ?>px">
					<li class="front-doc-slider__item front-doc-slider_item-left">
						<a href="#">
							<span class="front-doc-slider__item-mask"></span>
							<img />
						</a>
					</li>
					<li class="front-doc-slider__sep front-doc-slider_sep-l2r"><span></span></li>
					<li class="front-doc-slider__item front-doc-slider_item-right front-doc-slider_item-active">
						<a href="#">
							<span class="front-doc-slider__item-mask"></span>
							<img />
						</a>
					</li>
					<li class="front-doc-slider__sep front-doc-slider_sep-r2l"><span></span></li>
					<li class="front-doc-slider__item front-doc-slider_item-left">
						<a href="#">
							<span class="front-doc-slider__item-mask"></span>
							<img />
						</a>
					</li>
					<li class="front-doc-slider__sep front-doc-slider_sep-l2r"><span></span></li>
					<li class="front-doc-slider__item front-doc-slider_item-right">
						<a href="#">
							<span class="front-doc-slider__item-mask"></span>
							<img />
						</a>
					</li>
					<li class="front-doc-slider__sep front-doc-slider_sep-r2l"><span></span></li>
					<li class="front-doc-slider__item front-doc-slider_item-left">
						<a href="#">
							<span class="front-doc-slider__item-mask"></span>
							<img />
						</a>
					</li>
				</ul>
			</div>
			<a class="front-doc-slider__button front-doc-slider_button-next front-doc-slider_button-right" href="#"></a>
		</div>
        <!-- a class="front-content-carousel__arrow_top back" href="#"></a>
        <div class="front-content-carousel">
            <ul style="height: <?php echo $this->getRecommendationsPosts()->count() * 129; ?>px">
            	<?php $i = 0; ?>
            	<?php foreach ($this->getRecommendationsPosts() as $post): ?>
            		<?php 
            			$addClass = 'front-content-carousel__preview-picture_right';
            			$dotClass = 'carousel_dots-right';
            			if (!($i % 2)) {
							$addClass = 'front-content-carousel__preview-picture_left';
							$dotClass = 'carousel_dots-left';
						}
            		?>
	                <li class="front-content-carousel__preview-picture <?php echo $addClass; ?>">
	                    <a href="#" title="<?php echo $this->escape($post->getTitle()); ?>" description="<?php echo $this->escape($post->getDescription()); ?>" image="<?php echo $post->getImage(); ?>">
	                        <span class="front-carousel__preview-mask"></span>
	                        <?php if ($current->getImage()): ?>
					    	<?php
					    		$noImage = false;
					    		try {
					    			echo $this->image($post->getImage(), array(
					    				"alt"   => $this->escape($post->getTitle())
					    			))->resizeToFitCanvas(100, 118);
					    		} catch (Exception $e) {
									$noImage = true;
								}
					    	?>
					        <?php endif; ?>
	                        
	                    </a>
	                </li>
	                <?php if ($i < $this->getRecommendationsPosts()->count() - 1): ?>
	                	<li class="front-content-carousel-dots <?php echo $dotClass; ?>"><span></span></li>
	                <?php endif; ?>
	                <?php $i++; ?>
                <?php endforeach; ?>
                
            </ul>
        </div>
        <a class="front-content-carousel__arrow_bottom <?php echo !($this->getRecommendationsPosts()->count() & 2) ? 'carousel-buttom_modleft' : '' ?> next" href="#"></a-->
    </div>
</div>
<div class="front-body-sidebar-left">
    <?php echo Core::getBlock('navigation/index/sidebar-menu'); ?>
</div>