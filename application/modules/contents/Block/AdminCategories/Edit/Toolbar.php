<?php

class Contents_Block_AdminCategories_Edit_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Edit category'));
		
		$this->addButton(array(
			'name'  => 'save',
			'title' => $this->__('Save'),
			'urlOptions' => '*/*/save/back/true'
		));
		
		$this->addButton(array(
			'name'  => 'apply',
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