<?php

class Contents_Block_AdminPosts_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		if (isset(Core::getSession('contents/admin')->form)) {
			$this->setForm(Core::getSession('contents/admin')->form);
			unset(Core::getSession('contents/admin')->form);
		} else {
			$this->initForm();
		}
		
		$this->addBlockChild(
			Core::getBlock('contents/admin-posts/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function initForm()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		//$this->initLeftFrame();
		//$this->initCenterFrame();
		//$this->initRightFrame();
		
		$this->addElement('submit', 'back', array(
			'label'  => $this->__('Save and continue'),
			'ignore' => true,
		));
		
		$this->addElement('submit', 'save', array(
			'label'  => $this->__('Save'),
			'ignore' => true,
		));
		
		$this->loadDefaults();
	}
	
	/**
	 * Try to load defaults data from registry or session
	 */
	public function loadDefaults()
	{
		if (isset(Core::getSession('admin')->formData)) {
			$this->setDefaults(Core::getSession('admin')->formData);
			unset(Core::getSession('admin')->formData);
		} else if (Zend_Registry::isRegistered('form_data')) {
			$this->setDefaults(Zend_Registry::get('form_data'));
		}
	}
	
	public function initLeftFrame()
	{
		// HERE PLACE SOME HIDDEN DATA (FIX FOR SHOW LEFT FRAME)
		$this->addElement('hidden', 'id');
		$this->addElement('hash', 'csrf', array('ignore' => true));
		$this->addDisplayGroup(array('id', 'csrf'), 'leftFrame', array('legend' => 'leftFrame'));
	}
	
	public function initCenterFrame()
	{
		$centerFrame = new Zend_Form_Subform(array('legend' => 'centerFrame'));
		
		$centerFrame->addElement('select', 'contents_categories_id', array(
			'label' => $this->__('Category'),
			'required' => true,
			//'multiOptions' => $this->getContentsCategoriesId(),
		));
		
		$languages = array('fr', 'en');
		
		array_unshift($languages, 'default');
		foreach ($languages as $lang) {
			$languageFrame = new Zend_Form_Subform(array('legend' => $lang . 'LanguageFrame'));
			
			$languageFrame->addElement('text', 'title', array(
				'label' => $this->__('Title'),
				'required' => true,
			));
			
			$languageFrame->addElement('text', 'alias', array(
				'label' => $this->__('Alias'),
				'required' => true,
			));
			
			$languageFrame->addElement('textarea', 'introtext', array(
				'label' => $this->__('Intro text'),
				'rows' => 5,
				'cols' => 30,
			));
			
			$languageFrame->addElement('textarea', 'fulltext', array(
				'label' => $this->__('Full text'),
				'rows' => 5,
				'cols' => 30,
			));
						
			$centerFrame->addSubForm($languageFrame, $lang);
		}
		
		$this->addSubForm($centerFrame, 'centerFrame');
	}
	
	public function initRightFrame()
	{
		$rightFrame = new Zend_Form_Subform(array('legend' => 'rightFrame'));
		
		$rightFrame->addElement('checkbox', 'enabled', array(
			'label' => $this->__('Enabled'),
			'checkedValue' => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$rightFrame->addDisplayGroup(array('enabled'), 'mainParams', array('legend' => 'mainParams'));
		
		// Add left params
		$rightFrame->addElement('hidden', 'e1');
		$rightFrame->addElement('hidden', 'e2');
		$rightFrame->addElement('hidden', 'e3');
		
		$rightFrame->addDisplayGroup(array('e1'), 'additionalParamsG1', array('legend' => 'additionalParamsG1'));
		$rightFrame->addDisplayGroup(array('e2'), 'additionalParamsG2', array('legend' => 'additionalParamsG2'));
		$rightFrame->addDisplayGroup(array('e3'), 'additionalParamsG3', array('legend' => 'additionalParamsG3'));
		
		$this->addSubForm($rightFrame, 'rightFrame');
	}
}