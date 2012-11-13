<?php

/**
 * All meta tags renders here
 */
echo $this->headMeta();

?>
<?php

/**
 * All title branch renders here
 */
echo $this->headTitle();

?>
<?php

/**
 * All style sheets add here
 */
$this->headLink()->appendStylesheet('/layouts/e404/css/style.css');
echo $this->headLink();

?>
<?php

/**
 * All scripts files add here
 */
$this->headScript()->appendFile('/js/jquery/jquery-1.8.2.min.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/default/js/main.js', 'text/javascript');
echo $this->headScript();

?>
<script>
$(document).ready(function(){
	$(document).bind('keyup', function(e){
		if (e.keyCode == 192) {
			if ($('#exception-trace').css('display') == 'block') {
				$('#exception-trace').hide();
			} else {
				$('#exception-trace').show();
			}
		}
	});
});
</script>