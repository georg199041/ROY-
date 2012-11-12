<?php

class Contacts_Block_AdminGroups_Index extends Core_Block_Grid_Widget
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
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Title'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
		));
		
		$this->addColumn(array(
			'name'   => 'alias',
			'title'  => $this->__('Alias'),
			'width'  => '1%',
			'nowrap' => 'nowrap',
		));
		
		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('On'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));
		
		$this->setData(Core::getMapper('contacts/groups')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('contacts/admin-groups/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'contacts/admin-groups/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('contacts/groups')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}