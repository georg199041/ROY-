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
		));

		$this->addColumn(array(
			'name'           => 'table',
			'title'          => $this->__('Модуль / компонент'),
			'th-align'       => 'left',
			'width'          => '1%',
			'filterable'     => 'true',
			'filterableType' => Core_Block_Grid_Widget::FILTER_SELECT,
		));
		
		$this->addColumn(array(
			'name'           => 'comment',
			'title'          => $this->__('Комментарий'),
			'th-align'       => 'left',
		));
		
		$this->addColumn(array(
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('Вкл'),
			'align'          => 'center',
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));

		$this->addColumn(array(
			'name'           => 'enabled2',
			'type'           => 'checkbox',
			'title'          => $this->__('Нов'),
			'align'          => 'center',
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