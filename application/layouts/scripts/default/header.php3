<div class="front-header">
	<div class="front-header-width">
		<div class="front-header-infobox">
			<div class="front-header-cords front-header-cords__left">
				<?php if ($this->getMainUkraineTelephone()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						<b>Координаты в Москве:</b>
					</div>
					<div class="front-header-cords__item-content">
						<span class="front-header-cords__item-content-text">	
							г.Москва, ул.Дубнинская д.14, к.2 <br/>+7 (495) 668-12-73
						</span>	
					</div>
				</div>
				<?php endif; ?>
				<?php if ($this->getMainUkraineTelephone()->getId()): ?>
				<div class="front-header-cords__item">
					<div class="front-header-cords__item-title">
						Основной телефон в Украине:
					</div>
					<div class="front-header-cords__item-content">
						<span class="front-header-cords__item-content-text">	
							<?php echo $this->getMainUkraineTelephone()->getDescription(); ?>
						</span>	
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
								<a href="/" class="front-header-cords__item-content-map__item-text">	
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
		<div class="front-header-menu-container">
			<div class="front-header-menu-left"></div>
			<ul class="front-header-menu">
				<li class="front-header-menu__item">
					<a href="/" class="front-header-menu__item-href front-header-menu__item-href_active"><span class="front-header-menu_gradient">главная</span></a>
				</li>
				<li class="front-header-menu__item">
					<a href="/" class="front-header-menu__item-href front-header-menu__item-href_active"><span class="front-header-menu_gradient">о клубе</span></a>
				</li>
				<li class="front-header-menu__item">
					<a href="/" class="front-header-menu__item-href"><span class="front-header-menu_gradient">оздоравление и реабилитация</span></a>
				</li>
				<li class="front-header-menu__item">
					<a href="/" class="front-header-menu__item-href"><span class="front-header-menu_gradient">база клуба</span></a>
				</li>
				<li class="front-header-menu__item">
					<a href="/" class="front-header-menu__item-href"><span class="front-header-menu_gradient">контакты</span></a>
				</li>
			</ul>
			<div class="front-header-menu-right"></div>
		</div>
	</div>
</div>