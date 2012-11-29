<div class="front-body-slider-body">
	<div class="front-body-slider-top"></div>
	<div class="front-body-slider-blackwhite">
		<div class="front-body-slider-blackwhite-left"></div>
		<div class="front-body-slider-blackwhite-right"></div>
	</div>
	<div class="front-body-slider-color">
		<ul class="front-body-slider-color-wrap">
			<?php $i = 0; ?>
			<?php foreach ($this->getSlides() as $slide): ?>
				<li class="front-body-slider-color__item <?php echo $i == 0 ? 'active' : ''; ?>">
					<img src="<?php echo $slide->getImage(); ?>"
						 bg_left="<?php echo $slide->getImageLeft(); ?>"
						 bg_right="<?php echo $slide->getImageRight(); ?>" />
				</li>
				<?php $i++; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="front-body-slider-rectangle">
		<img src="/layouts/default/images/rectangle.png" />
		<div class="front-body-slider-buttons">
			<?php if ($this->getSlides()->count() > 0): ?>
				<input type="button" id="slider_back" class="slider_buttons" />
				<input type="button" id="slider_next" class="slider_buttons" />
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="front-push-slider"></div>