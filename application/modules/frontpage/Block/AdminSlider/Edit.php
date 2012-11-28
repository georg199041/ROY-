<?php

class Frontpage_Block_AdminSlider_Edit extends Core_Block_Form_Widget
{
	public function init()
	{
		$this->setAction('*/*/save');
		$this->getForm()->setName('form_data');
		
		$this->addElement('hidden', 'id');
		

		$this->addElement('text', 'image1', array(
			'label' => $this->__('Основная картинка'),
			'required'   => true,
			'validators' => array(
				array('NotEmpty', true, array('messages' => array(
					Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
				)))
			)
		));
		$this->getElement('image1')->setDecorators(array(
			array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('text', 'image2', array(
				'label' => $this->__('Фон слева'),
				'required'   => true,
				'validators' => array(
						array('NotEmpty', true, array('messages' => array(
								Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
						)))
				)
		));
		$this->getElement('image2')->setDecorators(array(
				array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('text', 'image3', array(
				'label' => $this->__('Фон справа'),
				'required'   => true,
				'validators' => array(
						array('NotEmpty', true, array('messages' => array(
								Zend_Validate_NotEmpty::IS_EMPTY => $this->__('Это поле не может быть пустым')
						)))
				)
		));
		$this->getElement('image3')->setDecorators(array(
				array('CombinedElement', array('btns' => array('select' => array('label' => 'Выбрать'))))
		));
		
		$this->addElement('checkbox', 'enabled', array(
			'label'          => $this->__('Включено'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
		));
		
		$this->addDisplayGroup(array('image1', 'image2', 'image3'), 'center');
		$this->addDisplayGroup(array('enabled'), 'right');
		
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
			Core::getBlock('frontpage/admin-slider/edit/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
}