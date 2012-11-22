<?php

class Navigation_Block_AdminPages_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		
		$this->addElement('hidden', 'id');
		
		$this->addElement('select', 'navigation_pages_id', array(
			'label'        => $this->__('Родитель'),
			'required'     => true,
			'multiOptions' => $this->getNavigationPagesId(Core::getMapper('navigation/pages')->fetchTree(), array('--- NO ---')),
		));
		
		$this->addElement('text', 'label', array(
			'label'    => $this->__('Заголовок'),
			'required' => true,
		));

		$this->addElement('text', 'uri', array(
			'label' => $this->__('УРЛ'),
		));
		
		$this->addElement('text', 'module', array(
			'label' => $this->__('Модуль'),
		));

		$this->addElement('text', 'controller', array(
			'label' => $this->__('Контроллер'),
		));

		$this->addElement('text', 'action', array(
			'label' => $this->__('Действие'),
		));

		$this->addElement('text', 'route', array(
			'label' => $this->__('Роут'),
		));
		
		$this->addElement('radio', 'type', array(
			'label'        => $this->__('Тип'),
			'multiOptions' => array(
				'MVC' => $this->__('Конструктор'),
				'URI' => $this->__('Ссылка'),
			)
		));

		$this->addElement('checkbox', 'reset_params', array(
			'label'          => $this->__('Сбрасывать'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));

		$this->addElement('checkbox', 'encode_url', array(
			'label'          => $this->__('Кодировать спец символы'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включено'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('navigation_pages_id', 'label', 'uri', 'module', 'controller', 'action', 'route'), 'center');
		$this->addDisplayGroup(array('type', 'enabled', 'reset_params', 'encode_url'), 'right');
		
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