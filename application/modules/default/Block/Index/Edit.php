<?php

class Default_Block_Index_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('#');
		$this->addElement('text', 'test', array('value' => 'TTTT'));
	}
}