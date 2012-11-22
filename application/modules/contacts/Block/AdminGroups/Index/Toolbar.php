<?php

class Contacts_Block_AdminGroups_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Группы контактов'));
		
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