<?php
/** Application_Block_Default_Header */
?>
<div class="front-header">
	<div class="front-header-width">
		<div class="front-header-infobox">
			<div class="front-header-cords front-header-cords__left">
				<?php if ($this->getMoscowOfficeMainPhone()->getId() || $this->getMoscowOfficeAddress()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						<b>Координаты в Москве:</b>
					</div>
					<div class="front-header-cords__item-content">
						<?php if ($this->getMoscowOfficeAddress()->getId()): ?>
						<div class="front-header-cords__item-content-text">
							<?php echo $this->getMoscowOfficeAddress()->getDescription(); ?>
						</div>
						<?php endif; ?>
						<?php if ($this->getMoscowOfficeMainPhone()->getId()): ?>
						<div class="front-header-cords__item-content-text">
							<?php echo $this->getMoscowOfficeMainPhone()->getDescription(); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->getCrimeaBaseMainPhone()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						Основной телефон в Украине:
					</div>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content-text">	
							<?php echo $this->getCrimeaBaseMainPhone()->getDescription(); ?>
						</div>	
					</div>	
				</div>
				<?php endif; ?>
			</div>
			<div class="front-header-cords front-header-cords__right">
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						База Клуба на картах:
					</div>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content-map">	
							<span class="front-header-cords__item-content-map__item">	
								<span class="front-header-cords__item-content-map__item-ico"></span>
								<a href="/" class="front-header-cords__item-content-map__item-href">	
									Google
								</a>
							</span>
							<span class="front-header-cords__item-content-map__item">	
								<span class="front-header-cords__item-content-map__item-ico"></span>
								<a href="/" class="front-header-cords__item-content-map__item-href">	
									Яндекс
								</a>
							</span>
						</div>
					</div>
				</div>
				<div class="front-header-cords__item front_socials-margin">
					<div class="front-header-cords__item-title">
						Расскажите о нас друзьям:
					</div>
					<div class="front-header-cords__item-content">
						<div class="front-header-cords__item-content_socials">
							<a href="/" class="front-header-cords__item-content_socials__item front_header-vk"></a>
							<a href="/" class="front-header-cords__item-content_socials__item front_header-fb"></a>
							<a href="/" class="front-header-cords__item-content_socials__item front_header-tw"></a>
							<a href="/" class="front-header-cords__item-content_socials__item front_header-google"></a>
						</div>	
					</div>	
				</div>
			</div>
			<a class="front-logo-text" href="/"></a>
		</div>
		<?php echo Core::getBlock('navigation/index/header-menu'); ?>
	</div>
</div>