<?php

class Params_Block_AdminNames_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label' => $this->__('Title'),
			'required' => true,
		));
		
		$this->addElement('select', 'params_categories_id', array(
			'label' => $this->__('Category'),
			'required' => true,
			'multiOptions' => array(),
		));
		
		$this->addElement('select', 'params_types_id', array(
			'label' => $this->__('Type'),
			'required' => true,
			'multiOptions' => array(),
		));

		$this->addElement('select', 'params_sources_id', array(
			'label' => $this->__('Source'),
			'multiOptions' => array(),
		));

		$this->addElement('textarea', 'predefined_source', array(
			'label' => $this->__('Predefined source'),
			'rows'  => 5,
			'cols'  => 30,
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label' => $this->__('Enabled'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addElement('submit', 'back', array(
			'label' => $this->__('Save and continue'),
			'ignore' => true,
		));

		$this->addElement('submit', 'save', array(
			'label' => $this->__('Save'),
			'ignore' => true,
		));
		
		if (isset(Core::getSession('admin')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('admin')->formData);
		} else if (Zend_Registry::isRegistered('form_data')) {
			$this->setDefaults(Zend_Registry::get('form_data'));
		}

		if (isset(Core::getSession('admin')->formHasErrors) && Core::getSession('admin')->formHasErrors) {
			$this->isValid($this->getValues());
			unset(Core::getSession('admin')->formHasErrors);
		}
		
		$this->addBlockChild(
			Core::getBlock('params/admin-names/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}