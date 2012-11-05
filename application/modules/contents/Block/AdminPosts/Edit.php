<?php

class Contents_Block_AdminPosts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('select', 'contents_categories_id', array(
			'label' => $this->__('Category'),
			'required' => true,
			'multiOptions' => $this->getContentsCategoriesId(),
		));
		
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
			Core::getBlock('contents/admin-posts/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function getContentsCategoriesId()
	{
		$collection = Core::getMapper('contents/categories')->fetchAll();
		$options = array('---');
		foreach ($collection as $item) {
			$options[$item->getId()] = $item->getTitle();
		}
		
		return $options;
	}
}