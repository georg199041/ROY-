<?php

class Default_Block_AdminCache_Index extends Core_Block_Grid_Widget
{
	public function init()
	{
		$this->setAttribute('width', '100%');		
		$this->setAttribute('cellpadding', 0);		
		$this->setAttribute('cellspacing', 0);
		
		$this->addColumn(array(
			'name'  => 'ids',
			'type'  => 'checkbox',
			'title' => '<input type="checkbox" />',
			'width' => '1%',
		));
		
		$this->addColumn(array(
			'name'     => 'label',
			'title'    => $this->__('Название'),
			'th-align' => 'left',
		));
		
		$this->addColumn(array(
			'name'     => 'grid_lifetime',
			'title'    => $this->__('Длительность'),
			'th-align' => 'left',
			'align'    => 'right',
			'nowrap'   => 'nowrap',
			'width'    => '1%',
		));
		
		$this->addColumn(array(
			'name'              => 'caching',
			'type'              => 'checkbox',
			'title'             => $this->__('Вкл'),
			'align'             => 'center',
			'checkedValue'      => '1',
			'uncheckedValue'    => '0',
			'width'             => '1%',
			'formactionOptions' => '*/*/enabled',
			'formactionBind'    => array('value' => 'caching', 'ids' => 'id')
		));
		
		$this->addColumn(array(
			'name'           => 'clear',
			'type'           => 'hyperlink',
			'title'          => '',
			'th-align'       => 'center',
			'linkStaticText' => $this->__('Очистить'),
			'linkOptions'    => '*/*/clear',
			'linkBindFields' => array('id'),
			'width'          => '1%',
		));
		
		$this->setData(Core::getMapper('default/cache')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('default/admin-cache/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);
	}
	
	/*public function getData()
	{
		//$options = Zend_Registry::get('Zend_Cache_Manager')->getCacheTemplates();
		
		//$config = new Zend_Config(array('resources' => array('cachemanager' => $options)), true);
		//$writer = new Zend_Config_Writer_Array(array('config' => $config, 'filename' => APPLICATION_PATH . '/modules/default/configs/cache.config.php'));
		//$writer->write();
		Core::getMapper('default/cache')->fetchAll();
		
		//var_dump(Zend_Registry::get('config'));
		
		return array(array('title' => 'test'));
	}*/
}