<?php

class Contacts_Block_AdminGroups_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('text', 'title', array(
			'label'    => $this->__('Title'),
			'required' => true,
		));

		$this->addElement('text', 'alias', array(
			'label'    => $this->__('Alias'),
			'required' => true,
		));
		
		$this->addElement('textarea', 'description', array(
			'label' => $this->__('Description'),
		));

		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Enabled'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addElement('submit', 'back', array(
			'label'  => $this->__('Save and continue'),
			'ignore' => true,
		));

		$this->addElement('submit', 'save', array(
			'label'  => $this->__('Save'),
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
			Core::getBlock('contacts/admin-groups/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}