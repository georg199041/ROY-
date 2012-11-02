<div class="layout_header">
	<div class="layout_header_width">
		<a class="layout_logo_text" href="/"><?php echo $this->translate('Skeleton Application', 'ru'); ?></a>
		<div class="layout_header_menu">
			<?php
				$root = Zend_Registry::get('Zend_Navigation')->findOneById('default/admin-index/index');
				echo $this->navigation($root)
				          ->menu()
				          ->render();
			?>
		</div>
	</div>
</div>