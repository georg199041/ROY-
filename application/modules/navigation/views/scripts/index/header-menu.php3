<div class="front-header-menu-container">
	<div class="front-header-menu-left"></div>
	<ul class="front-header-menu">
		<?php if (count($this->getHeaderMenu())): ?>
			<?php foreach ($this->getHeaderMenu() as $page): ?>
				<li class="front-header-menu__item">
					<a href="<?php echo $page->getHref(); ?>" class="front-header-menu__item-href <?php if ($this->isActive($page)): ?>front-header-menu__item-href_active<?php endif; ?>">
						<span class="front-header-menu-gradient"><?php echo $page->getLabel(); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<div class="front-header-menu-right"></div>
</div>