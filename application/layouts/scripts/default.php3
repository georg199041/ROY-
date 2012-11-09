<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('Skeleton Application')); ?>
	<?php echo $this->partial('default/head.php3'); ?>
</head>
<body>
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo $this->partial('default/header.php3'); ?>
	<div class="front-body">
		<div class="front-push-top"></div>
		<div class="front-body-container">
			<?php echo $this->partial('default/body.php3'); ?>
		</div>
		<div class="front-push-bottom"></div>
	</div>
	<div class="front-footer">
		<div class="front-footer-width">
			<div class="front-footer-text">Footer</div>
		</div>
	</div>
</body>
</html>