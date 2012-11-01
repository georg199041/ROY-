<?php

require_once 'Core/Block/View.php';

class Contents_Block_AdminStaticPosts_Index extends Core_Block_View
{
	public function init()
	{
		$this->addBlockChilds(array(
			'contents/admin-static-posts/index-toolbar' => array(
				'title' => $this->__('Manage static posts'),
				'type' => 'toolbar',
				'buttons' => array(
					array(
						'name'  => 'show',
						'title' => $this->__('Show'),
						'urlOptions' => '*/*/status/enabled/YES'
					),
					array(
						'name'  => 'hide',
						'title' => $this->__('Hide'),
						'urlOptions' => '*/*/status/enabled/NO'
					),
					array(
						'name'  => 'delete',
						'title' => $this->__('Delete'),
						'urlOptions' => '*/*/delete'
					),
					array(
						'name'  => 'add',
						'title' => $this->__('Add'),
						'urlOptions' => '*/*/edit'
					),
				),
				'links' => array(
					array(
						'name' => 'categories',
						'title' => $this->__('Categories'),
						'urlOptions' => '*/admin-categories'
					),
					array(
						'name' => 'posts',
						'title' => $this->__('Posts'),
						'urlOptions' => '*/admin-posts'
					),
					array(
						'name' => 'static-posts',
						'title' => $this->__('Static posts'),
						'urlOptions' => '*/*'
					),
				)
			),
			'news/admin-index/index-grid' => array(
				'type'  => 'grid',
				'width' => '100%',
				'cellpadding' => 0,
				'cellspacing' => 0,
				'data' => Core::getMapper('contents/static-posts')->fetchAll(),
				'columns' => array(
					'ids' => array(
						'type' => 'checkbox',
						'title' => '',
						'width' => '1%',
					),
					'id' => array(
						'title' => $this->__('ID'),
						'width' => '1%',
						'align' => 'right',
					),
					'title' => array(
						'type' => 'hyperlink',
						'title' => $this->__('Title'),
						'th-align' => 'left',
						'linkOptions' => '*/*/edit',
						'linkBindFields' => array('id'),
					),
					'alias' => array(
						'title' => $this->__('Alias'),
						'width' => '1%',
						'nowrap' => 'nowrap',
					),
					'enabled' => array(
						'type' => 'checkbox',
						'title' => $this->__('On'),
						'checkedValue' => 'YES',
						'uncheckedValue' => 'NO',
						'width' => '1%',
					),
					'created_ts' => array(
						'title' => $this->__('Date created'),
						'width' => '1%',
					),
				)
			),
			'news/admin-index/index-pagination' => array(
				'type' => 'pagination',
				'totalItemsCount' => Core::getMapper('contents/static-posts')->fetchCount()*10,
			)
		));
	}
}