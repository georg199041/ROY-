<?php

class Contacts_Block_Index_Feedback extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'name', array(
			'label'    => 'Ваше имя',
			'required' => true,
		));
		
		$this->addElement('text', 'email', array(
			'label'    => 'Адрес электроной почты (не публикуется)',
			'required' => true,
		));
		
		$this->addElement('textarea', 'comment', array(
			'label'    => 'Текст сообщения',
			'required' => true,
			'cols'     => 40,
			'rows'     => 10,
		));
		
		$this->addElement('submit', 'submit', array(
			'value'       => 'Отправить',
			'ignore'      => true,
			'description' => 'Все поля обязательны к заполнению'
		));
	}
}