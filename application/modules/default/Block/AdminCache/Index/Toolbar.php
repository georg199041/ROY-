<?php

class Default_Block_AdminCache_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Управление кешем'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/enabled/value/1',
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/enabled/value/0',
		));
		
		$this->addButton(array(
			'name'       => 'clean',
			'title'      => $this->__('Очистить'),
			'urlOptions' => '*/*/clean',
		));
	}
}