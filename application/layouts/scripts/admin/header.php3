<div class="layout_header">
	<div class="layout_header_width">
		<a class="layout_logo_text" href="<?php echo $this->url(Core::urlToOptions('default/admin-index/index'), null, true); ?>">Администратор</a>
		<div class="layout_header_menu">
			<?php
				$root = Zend_Registry::get('Zend_Navigation')->findOneById('default/admin-index/index');
				echo $this->navigation($root)
				          ->menu()
				          ->render();
			?>
		</div>
		<div class="admin-info">
			<a href="#" class="admin-info__button">(1)</a>
			<?php //echo $this->flashMessenger(); ?>
			<?php echo Core::getBlock('application/admin/messenger'); ?>
		</div>
	</div>
</div>