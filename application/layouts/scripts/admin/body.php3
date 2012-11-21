<div style="padding: 0 10px 0">
<?php $root = Zend_Registry::get('Zend_Navigation')->findOneById('default/admin-index/index');
	echo $this->navigation($root)
	          ->breadcrumbs()
	          ->setMinDepth(0)
	          ->render();
?>
</div>
<?php echo $this->layout()->content; ?>