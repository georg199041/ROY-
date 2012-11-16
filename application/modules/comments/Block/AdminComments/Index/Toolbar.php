<?php

class Comments_Block_AdminComments_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Комментарии'));
		
		$this->addButton(array(
			'name'       => 'show',
			'title'      => $this->__('Показать'),
			'urlOptions' => '*/*/enabled/value/YES'
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