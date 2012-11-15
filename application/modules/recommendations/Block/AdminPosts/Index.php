<?php

class Recommendations_Block_AdminPosts_Index extends Core_Block_Grid_Widget
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
			'width' => '50',
			'align' => 'right',
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_EQUAL,
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
		
		$this->setData(Core::getMapper('recommendations/posts')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('recommendations/admin-posts/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'recommendations/admin-posts/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('recommendations/posts')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
}