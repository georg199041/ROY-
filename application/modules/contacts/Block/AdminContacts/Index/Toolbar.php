<?php

class Contacts_Block_AdminContacts_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Контакты'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Включить'),
			'urlOptions' => '*/*/enabled/value/YES',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Выключить'),
			'urlOptions' => '*/*/enabled/value/NO',
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