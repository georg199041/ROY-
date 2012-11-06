<?php

class Params_Block_AdminTypes_Index extends Core_Block_Grid_Widget
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
			'name'           => 'code',
			'type'           => 'hyperlink',
			'title'          => $this->__('Code'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));

		$this->addColumn(array(
			'name'   => 'title',
			'title'  => $this->__('Title'),
			'width'  => '1%',
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
		
		$this->setData(Core::getMapper('params/types')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('params/admin-types/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'params/admin-types/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('params/types')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}