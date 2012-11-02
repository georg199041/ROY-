<?php

/**
 * All meta tags renders here
 */
//$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
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
$this->headLink()->appendStylesheet('/layouts/default/css/style.css');
echo $this->headLink();

?>
<?php

/**
 * All scripts files add here
 */
//$this->headScript()->appendFile('/js/prototype.js', 'text/javascript'/*, array('conditional' => 'lt IE 7')*/);
echo $this->headScript();

?>