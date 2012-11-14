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
echo $this->headTitle()->setSeparator(' | ');

?>
<?php

/**
 * All style sheets add here
 */
$this->headLink()->appendStylesheet('/layouts/admin/css/style.css');
echo $this->headLink();

?>
<?php

/**
 * All scripts files add here
 */
$this->headScript()->appendFile('/js/jquery/jquery-1.8.2.min.js', 'text/javascript');
$this->headScript()->appendFile('/layouts/admin/js/admin.js', 'text/javascript');
echo $this->headScript();

?>