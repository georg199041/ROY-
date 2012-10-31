<?php

require_once 'Core/Block/Form/Widget.php';

class Contents_Block_AdminStaticPosts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label' => $this->__('Title'),
			'required' => true,
		));
		
		$this->addElement('text', 'alias', array(
			'label' => $this->__('Alias'),
			'required' => true,
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label' => $this->__('Enabled'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addElement('textarea', 'introtext', array(
			'label' => $this->__('Intro text'),
			'rows' => 5,
			'cols' => 30,
		));
		
		$this->addElement('textarea', 'fulltext', array(
			'label' => $this->__('Full text'),
			'rows' => 5,
			'cols' => 30,
		));
		
		$this->addElement('submit', 'submit', array(
			'label' => $this->__('Save'),
			'ignore' => true,
		));
		
		if (isset(Core::getSession('admin')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('admin')->formData);
		} else if (Zend_Registry::isRegistered('form_data')) {
			$this->setDefaults(Zend_Registry::get('form_data'));
		}
	}
}