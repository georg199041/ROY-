<?php

class Contacts_Block_AdminContacts_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Edit contact'));
		
		$this->addButton(array(
			'name'  => 'save',
			'title' => $this->__('Save'),
			'urlOptions' => '*/*/save'
		));
		
		$this->addButton(array(
			'type'  => 'submit',
			'name'  => 'back',
			'title' => $this->__('Apply'),
			'urlOptions' => '*/*/save'
		));
		
		$this->addButton(array(
			'name'  => 'cancel',
			'title' => $this->__('Cancel'),
			'urlOptions' => '*/*/index'
		));
	}
}