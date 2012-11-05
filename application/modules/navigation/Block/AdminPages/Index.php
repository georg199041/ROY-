<?php

class Navigation_Block_AdminPages_Index extends Core_Block_Grid_Widget
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
			'name'  => 'id',
			'title' => $this->__('ID'),
			'width' => '1%',
			'align' => 'right',
		));
		
		$this->addColumn(array(
			'name'           => 'label',
			'type'           => 'hyperlink',
			'title'          => $this->__('Label'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));

		$this->addColumn(array(
			'name'  => 'type',
			'title' => $this->__('Type'),
			'width' => '1%',
		));
		
		$this->addColumn(array(
			'name'           => 'encode_url',
			'type'           => 'checkbox',
			'title'          => $this->__('Encode'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));
		
		$this->addColumn(array(
			'name'           => 'reset_params',
			'type'           => 'checkbox',
			'title'          => $this->__('Reset'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));

		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('On'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));
		
		$this->addColumn(array(
			'name'  => 'created_ts',
			'title' => $this->__('Date created'),
			'width' => '1%',
		));

		$this->addColumn(array(
			'name'  => 'modified_ts',
			'title' => $this->__('Date modified'),
			'width' => '1%',
		));
		
		$this->setData(Core::getMapper('navigation/pages')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('navigation/admin-pages/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'navigation/admin-pages/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('navigation/pages')->fetchCount()*10,
		), self::BLOCK_PLACEMENT_AFTER);
	}
}