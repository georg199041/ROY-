<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('Skeleton Application')); ?>
	<?php echo $this->partial('default/head.php3'); ?>
</head>
<body>
	<div class="layout_fullscreen_wait"></div>
	<div class="modal_container"></div>
	<?php echo $this->partial('default/header.php3'); ?>
	<div class="layout_body">
		<div class="layout_push_top"></div>
		<div class="layout_body_container">
			<?php echo $this->partial('default/body.php3'); ?>
		</div>
		<div class="layout_push_bottom"></div>
	</div>
	<div class="layout_footer">
		<div class="layout_footer_width">
			<div class="layout_footer_text">Footer</div>
		</div>
	</div>
</body>
</html>