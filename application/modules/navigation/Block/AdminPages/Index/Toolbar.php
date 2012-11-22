<?php

class Navigation_Block_AdminPages_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Управление страницами'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/status/enabled/YES',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/status/enabled/NO',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'move',
			'title'      => $this->__('Переместить'),
			'urlOptions' => '*/*/move',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'copy',
			'title'      => $this->__('Копировать'),
			'urlOptions' => '*/*/copy',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'delete',
			'title'      => $this->__('Удалить'),
			'urlOptions' => '*/*/delete',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'add',
			'title'      => $this->__('Создать'),
			'urlOptions' => '*/*/edit',
			'onclick'    => "callAction(this)",
		));
	}
}