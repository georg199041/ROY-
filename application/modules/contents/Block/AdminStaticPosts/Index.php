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
						'urlOptions' => '*/*/enable/value/YES'
					),
					array(
						'name'  => 'hide',
						'title' => $this->__('Hide'),
						'urlOptions' => '*/*/enable/value/NO'
					),
					array(
						'name'  => 'delete',
						'title' => $this->__('Delete'),
						'urlOptions' => '*/*/delete'
					),
					array(
						'name'  => 'add',
						'title' => $this->__('Add'),
						'urlOptions' => '*/*/add'
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
			'news/admin-index/grid' => array(
				'type'  => 'grid',
				'width' => '100%',
				'cellpadding' => 0,
				'cellspacing' => 0,
				'data' => $this->getGridData(),
				'columns' => array(
					'id' => array('title' => 'ID', 'width' => '1%'),
					'key' => array('title' => 'KEY', 'width' => '1%'),
					'title' => array('title' => 'Название', 'align' => 'center', 'th-align' => 'left'),
					'alias' => array('title' => 'Псевдоним', 'width' => '1%'),
					'news_categories_id' => array('title' => 'Категория', 'width' => '1%'),
					'created_ts' => array('title' => 'Дата создания', 'width' => '1%')
				)
			)
		));
	}
	
	public function getGridData()
	{
		$mapper = Core::getInstance()->getMapper('contents/static-posts');
		$collection = $mapper->fetchAll();
		return $collection;
	}
}