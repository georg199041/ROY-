<?php

class Navigation_Block_AdminPages_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Редактирование страницы'));
		
		$this->addButton(array(
			'name'  => 'save',
			'title' => $this->__('Сохранить'),
			'urlOptions' => '*/*/save/back/true'
		));
		
		$this->addButton(array(
			'name'  => 'apply',
			'title' => $this->__('Применить'),
			'urlOptions' => '*/*/save'
		));
		
		$this->addButton(array(
			'name'  => 'cancel',
			'title' => $this->__('Назад'),
			'urlOptions' => '*/*/index'
		));
	}
}