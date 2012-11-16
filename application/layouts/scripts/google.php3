<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->headTitle($this->translate('Roy')); ?>
	<?php $this->headScript()->appendFile('http://maps.google.com/maps/api/js?sensor=false', 'text/javascript'); ?>
	<?php echo $this->partial('default/head.php3'); ?>
</head>
<body class="front-map-page">
	<div class="front-fullscreen-wait"></div>
	<div class="front-modal-container"></div>
	<?php echo Core::getBlock('application/default/header'); ?>
	<div class="front-body">
		<div id="front-fullscreen-map" class="front-fullscreen-map">1
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				var options = {
					zoom:      14,
					center:    new google.maps.LatLng((44.836213 - 0.005), (34.324379 + 0.025)),
					mapTypeId: google.maps.MapTypeId.SATELLITE
				};
				var map = new google.maps.Map(document.getElementById("front-fullscreen-map"), options);
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(44.836213, 34.324379),
					map:      map,
					title:    "Ya marker",
					icon:     "/layouts/default/images/map-marker.png"
				});
			});
		</script>
		<div class="front-push-top"></div>
		<div class="front-body-container">
			<?php echo $this->partial('default/body.php3'); ?>
		</div>
		<div class="front-push-bottom"></div>
	</div>
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