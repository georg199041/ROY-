<?php

class Contacts_Block_Index_Feedback extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'name', array(
			'label'      => 'Ваше имя',
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('text', 'email', array(
			'label'      => 'Адрес электроной почты (не публикуется)',
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('textarea', 'message', array(
			'label'    => 'Текст сообщения',
			'cols'     => 40,
			'rows'     => 10,
			'required' => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('submit', 'submit', array(
			'value'       => 'Отправить',
			'ignore'      => true,
			'description' => 'Все поля обязательны к заполнению'
		));
	}
}