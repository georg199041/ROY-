<?php

class Navigation_Block_AdminPages_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('select', 'navigation_pages_id', array(
			'label'        => $this->__('Parent'),
			'required'     => true,
			'multiOptions' => $this->getNavigationPagesId(Core::getMapper('navigation/pages')->fetchTree(), array('--- NO ---')),
		));
		
		$this->addElement('text', 'label', array(
			'label'    => $this->__('Label'),
			'required' => true,
		));

		$this->addElement('text', 'uri', array(
			'label' => $this->__('Url'),
		));
		
		$this->addElement('text', 'module', array(
			'label' => $this->__('Module'),
		));

		$this->addElement('text', 'controller', array(
			'label' => $this->__('Controller'),
		));

		$this->addElement('text', 'action', array(
			'label' => $this->__('Action'),
		));

		$this->addElement('text', 'route', array(
			'label' => $this->__('Route'),
		));
		
		$this->addElement('radio', 'type', array(
			'label'        => $this->__('Type'),
			'multiOptions' => array(
				'MVC' => $this->__('MVC'),
				'URI' => $this->__('URI'),
			)
		));

		$this->addElement('checkbox', 'reset_params', array(
			'label'          => $this->__('Reset'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));

		$this->addElement('checkbox', 'encode_url', array(
			'label'          => $this->__('Encode'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
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
			Core::getBlock('navigation/admin-pages/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	public function getNavigationPagesId($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) . $item->getLabel();
			$result = $this->getNavigationPagesId($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
}