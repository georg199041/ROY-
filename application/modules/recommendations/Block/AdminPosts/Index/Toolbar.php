<?php

class Recommendations_Block_AdminPosts_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Рекоммендации'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Показать'),
			'urlOptions' => '*/*/enabled/value/YES',
			'onclick'    => "callAction(this, '.cbgw-column__ids input:checked')",
		));
		
		$this->addButton(array(
			'name'       => 'hide',
			'title'      => $this->__('Скрыть'),
			'urlOptions' => '*/*/enabled/value/NO'
		));
		
		$this->addButton(array(
			'name'       => 'delete',
			'title'      => $this->__('Удалить'),
			'urlOptions' => '*/*/delete'
		));
		
		$this->addButton(array(
			'name'       => 'add',
			'title'      => $this->__('Создать'),
			'urlOptions' => '*/*/edit'
		));
	}
}