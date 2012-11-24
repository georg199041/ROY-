<?php

class Comments_Block_AdminComments_Index extends Core_Block_Grid_Widget
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
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_EQUAL,
			'filterableOptions' => array('size' => '1'),
		));
		
		$this->addColumn(array(
			'name'           => 'title',
			'type'           => 'hyperlink',
			'title'          => $this->__('Title'),
			'th-align'       => 'left',
			'linkOptions'    => '*/*/edit',
			'linkBindFields' => array('id'),
			'filterable'     => 'true',
			'filterableType' => Core_Block_Grid_Widget::FILTER_LIKE,
		));
		
		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('On'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));
		
		$this->setData(Core::getMapper('comments/comments')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('comments/admin-comments/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'comments/admin-comments/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('comments/comments')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}