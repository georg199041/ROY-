<?php

class Documents_Block_AdminPosts_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Редактирование документа'));
		
		$this->addButton(array(
			'type'  => 'submit',
			'name'  => 'save',
			'title' => $this->__('Сохранить'),
			'urlOptions' => '*/*/save'
		));
		
		$this->addButton(array(
			'type'  => 'submit',
			'name'  => 'back',
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