<?php

class Comments_Block_Index_AddComment extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('/comments/index/add-comment');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'table');
		$this->addElement('hidden', 'table_id');
		$this->addElement('hidden', 'back_url', array('ignore' => true));
		
		$this->addElement('text', 'name', array(
			'label'    => 'Ваше имя',
			'required' => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('text', 'email', array(
			'label'    => 'Адрес электроной почты (не публикуется)',
			'required' => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		
		$this->addElement('textarea', 'comment', array(
			'label'    => 'Текст сообщения',
			'required' => true,
			'cols'     => 40,
			'rows'     => 10,
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
		
		if (isset(Core::getSession('front')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('front')->formData);
		}
		
		if (isset(Core::getSession('front')->formHasErrors) && Core::getSession('front')->formHasErrors) {
			$this->isValid($this->getValues());
			unset(Core::getSession('front')->formHasErrors);
		}
		
		$this->getElement('submit')->setValue('Отправить');
	}
	
	public function setCommentsTable($value)
	{
		if ($this->getElement('table')) {
			$this->getElement('table')->setValue($value);
		}
	}
	
	public function setCommentsTableId($value)
	{
		if ($this->getElement('table_id')) {
			$this->getElement('table_id')->setValue($value);
		}
	}
	
	public function setBackUrl($value)
	{
		if ($this->getElement('back_url')) {
			$this->getElement('back_url')->setValue($value);
		}
	}
}