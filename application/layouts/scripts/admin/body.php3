<?php $root = Zend_Registry::get('Zend_Navigation')->findOneById('default/admin-index/index');
	echo $this->navigation($root)
	          ->breadcrumbs()
	          ->render();
?>
<?php echo $this->layout()->content; ?>