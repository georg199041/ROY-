<?php
//echo $this->column->getName();
if (is_null($this->column->getValue())) {
	echo 'IS_NULL';
} else if (is_numeric($this->column->getValue())) {
	echo 'IS_NUMERIC';
} else {
	echo 'UNDEFINED_TYPE';
}
?>