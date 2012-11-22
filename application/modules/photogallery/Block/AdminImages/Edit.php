<?php

class Photogallery_Block_AdminImages_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');

		$this->addElement('hidden', 'id');

		$this->addElement('text', 'title', array(
				'label'    => $this->__('Заголовок'),
				'required' => true,
		));

		$this->addElement('textarea', 'description', array(
				'label' => $this->__('Описание'),
				'cols' => 70,
				'rows' => 15,
		));

		$this->addElement('text', 'image', array(
				'label' => $this->__('Картинка'),
		));

		$this->addElement('select', 'enabled', array(
				'label'          => $this->__('Включено'),
				'multiOptions'	 => array(
						"YES"=>"YES",
						"NO" =>"NO"
				),
// 				'checkedValue'   => 'YES',
// 				'uncheckedValue' => 'NO',
		));

		$this->addDisplayGroup(array('title', 'description'), 'center');
		$this->addDisplayGroup(array('image', 'enabled'), 'right');

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
				Core::getBlock('photogallery/admin-images/edit/toolbar'),
				self::BLOCK_PLACEMENT_BEFORE
		);
	}
}