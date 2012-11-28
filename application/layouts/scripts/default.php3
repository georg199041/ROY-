<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="favicon.ico" href="/favicon.ico" type="image/x-icon">
	<?php $this->headTitle($this->translate('РОЙ')); ?>
	<?php echo $this->partial('default/head.php3'); ?>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?63"></script>

	<script type="text/javascript">
	  VK.init({apiId: 3221100, onlyWidgets: true, pageUrl: document.location.hash});
	</script>
	
	<script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	
</head>
<body>
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo Core::getBlock('application/default/header'); ?>
	<div class="front-body">
		<div class="front-push-top"></div>
		<?php if ($this->isHomePage()): ?>
		
		<div class="front-body-slider-body">
			<div class="front-body-slider-top"></div>
			<div class="front-body-slider-blackwhite" >
				<div class="front-body-slider-blackwhite-left"></div>
				<div class="front-body-slider-blackwhite-right"></div>
			</div>
			
			<div class="front-body-slider-color">
				<ul class="front-body-slider-color-wrap" >
					<li class="front-body-slider-color__item">
						<img src="/uploads/front-page-slider/main-promo-collage--center.jpg" bg_left="/uploads/front-page-slider/main-promo-collage--left.jpg" bg_right="/uploads/front-page-slider/main-promo-collage--right.jpg"/>
					</li>
					<li class="front-body-slider-color__item">
						<img src="/uploads/front-page-slider/main-promo-collage--center.jpg" bg_left="/uploads/front-page-slider/main-promo-collage--left.jpg" bg_right="/uploads/front-page-slider/main-promo-collage--right.jpg"/>
					</li>
					<li class="front-body-slider-color__item">
						<img src="/uploads/front-page-slider/main-promo-collage--center.jpg" bg_left="/uploads/front-page-slider/main-promo-collage--left.jpg" bg_right="/layouts/default/images/main-promo-collage--right.jpg"/>
					</li>
				</ul>
				
			</div>
			<div class="front-body-slider-rectangle">
				<img src="/layouts/default/images/rectangle.png"/>
				<div class="front-body-slider-buttons">
					<input type="button" id="slider_back" class="slider_buttons" />
					<input type="button" id="slider_next" class="slider_buttons" />
				</div>
			</div>
			
		
		</div>
		<div class="front-push-slider"></div>
		<?php endif; ?>
		<div class="front-body-container front_clearfix">
			<?php echo $this->partial('default/body.php3'); ?>
			<div class="front_clearfix"></div>
		</div>
		<?php if ($this->isHomePage()): ?>
		<div class="front-focused-on-results">
			<div class="front-focused-on-results__bg">
				<div class="front-focused-on-results__center">
					<div class="front-focused-on-results__bg-over">
						<div class="front-focused-on-results__content">
							<h1>Мы нацелены на результат</h1>
							<p>Авторская программа реабилитации наркозависимых включает в себя проживание в деревянных домиках в природных условиях, а так же использование природных оздоровительных процедур.</p>
							<p>На территории лагеря оборудована баня, речная купель, спортивная площадка. Проживание и столовая расположены в комфортабельных домиках "финского типа". Жилые помещения центра имеют все условия для круглогодичной реабилитации наркозависимых и лечения наркомании. Спортивный зал с мягким покрытием предназначен для круглогодичного использования и расположен в утепленных палатках армейского типа. В зимний период жилые помещения обогреваются русскими печами.</p>
						</div>
						<div class="front_clearfix"></div>
					</div>
					<div class="front-focused-on-results__button-placeholder">
						<a href="#" class="front-focused-on-results__button">
							<span class="corners"><span class="dots">СДЕЛАЕМ ЭТО ВМЕСТЕ!</span></span>
						</a>
					</div>
					<div class="front-focused-on-results__ws"></div>
				</div>
			</div>
		</div>
		<div class="front-focused-on-results-push"></div>
		<?php endif; ?>
		<div class="front-push-bottom"></div>
	</div>
	<div class="front-footer">
		<div class="front-footer-width">
			<div class="front-footer-box">
				<div class="front-footer-box-rights">
					<div class="front-footer-box-rights-text">
						© Клуб «РОЙ», 2012. Все права защищены
					</div>
					<div class="front-footer-box-rights-logo">
						<a href="http://sunny.net.ua/" target="_blank" class="front-footer-box-rights-logo-a"></a>					
					</div>
				</div>
				<div class="front-footer-box-line"></div>
			</div>
		</div>
	</div>
	
</body>
</html>