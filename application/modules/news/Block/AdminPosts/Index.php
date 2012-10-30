<?php

class News_Block_AdminPosts_Index extends Core_Block_View
{
	public function init()
	{
		/*$toolbar = new Core_Block_Toolbar_Widget(array(
			'title' => $this->__('Manage news'),
			'name' => 'news/admin-index/index',
			'buttons' => array(
				array(
					'name'  => 'save',
					'title' => 'Сохранить',
					'urlOptions' => array('action' => 'save')
				)
			),
			'links' => array(
				array(
					'name' => 'categories',
					'title' => $this->__('Categories')
				)
			)
		));
		
		$this->addBlockChild($toolbar);*/
		//$this->getGridData();
		$this->addBlockChilds(array(
			'news/admin-index/toolbar' => array(
				'title' => $this->__('Manage news'),
				'type' => 'toolbar',
				'buttons' => array(
					array(
						'name'  => 'save',
						'title' => $this->__('Save'),
						'urlOptions' => array('action' => 'save')
					)
				),
				'links' => array(
					array(
						'name' => 'categories',
						'title' => $this->__('Categories'),
						'urlOptions' => array('controller' => 'admin-categories')
					)
				)
			),
			'news/admin-index/grid' => array(
				'type' => 'grid',
				'width' => '100%',
				'data' => $this->getGridData(),
				'columns' => array(
					'id' => array('title' => 'ID', 'width' => '1%'),
					'key' => array('title' => 'KEY', 'width' => '1%'),
					'title' => array('title' => 'Название'),
					'alias' => array('title' => 'Псевдоним', 'width' => '1%'),
					'news_categories_id' => array('title' => 'Категория', 'width' => '1%'),
					'created_ts' => array('title' => 'Дата создания', 'width' => '1%')
				)
			)
		));
	}
	
	public function getGridData()
	{
		$mapper = Core::getInstance()->getMapper('news/news-posts');
		$collection = $mapper->fetchAll();
		
		return $collection;
	}
}