<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('Roy')); ?>
	<?php echo $this->partial('default/head.php3'); ?>
</head>
<body>
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo Core::getBlock('application/default/header'); ?>
	<div class="front-body">
		<div class="front-push-top"></div>
		<div class="front-body-slider-body">
			<div class="front-body-slider-blackwhite">
				<ul class="front-body-slider-blackwhite-wrap">
					<li class="front-body-slider-blackwhite__item">
						<img src="/layouts/default/images/bw_slide1.jpg"/>
					</li>
				</ul>
			</div>
			<div class="front-body-slider-color">
				<ul class="front-body-slider-color-wrap" >
					<li class="front-body-slider-color__item">
						<img src="/layouts/default/images/main-banner-color.jpg"/>
					</li>
				</ul>
<!-- 				<div class="front-body-slider-color-cutter-container"><div class="front-body-slider-color-cutter"></div></div> -->
			</div>
			<div class="front-body-slider-rectangle">
				<input type="button" id="slider_back" class="slider_buttons" />
				<input type="button" id="slider_next" class="slider_buttons" />
			</div>
		</div>
		<div class="front-body-container">
			<?php echo $this->partial('default/body.php3'); ?>
		</div>
		<div class="front-push-bottom"></div>
	</div>
	<div class="front-result-box">
		<div class="front-footer-box">	
			<div class="front-result-box-cont">
				<div class="front-result-box-title">
					<span class="front-title-content">Мы нацелены на результат</span>
				</div>
				<div class="front-result-box-text">
					<p>Авторская программа реабилитации наркозависимых включает в себя проживание в деревянных домиках в природных условиях, а так же использование природных оздоровительных процедур.</p>
					<p>На территории лагеря оборудована баня, речная купель, спортивная площадка. Проживание и столовая расположены в комфортабельных домиках "финского типа". Жилые помещения центра имеют все условия для круглогодичной реабилитации наркозависимых и лечения наркомании. Спортивный зал с мягким покрытием предназначен для круглогодичного использования и расположен в утепленных палатках армейского типа. В зимний период жилые помещения обогреваются русскими печами.</p>
				</div>
			</div>
			
		</div>	
		
	</div>
	<div class="front-result-result-box-align">
				<a href="/" class="front-result-box-button">
					<span class="front-result-box-button-text">СДЕЛАЕМ ЭТО ВМЕСТЕ!</span>
				</a>
			</div>	
	<div class="front-footer-white-stripe"></div>
	<div class="front-footer">
		<div class="front-footer-width">
			<div class="front-footer-box">
				<div class="front-footer-box-rights">
					<div class="front-footer-box-rights-text">
						© Клуб «РОЙ», 2012. Все права защищены
					</div>
					<div class="front-footer-box-rights-logo">
						<a href="/" class="front-footer-box-rights-logo-a"></a>					
					</div>
				</div>
				<div class="front-footer-box-line"></div>
			</div>	
			
		</div>
		
	</div>
</body>
</html>