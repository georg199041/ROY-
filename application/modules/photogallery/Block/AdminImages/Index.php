<?php

class Photogallery_Block_AdminImages_Index extends Core_Block_Grid_Widget
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
			'name'           => 'enabled',
			'type'           => 'checkbox',
			'title'          => $this->__('On'),
			'checkedValue'   => 'YES',
			'uncheckedValue' => 'NO',
			'width'          => '1%',
		));

		$this->addColumn(array(
			'type'              => 'hyperlink',
			'name'              => 'photogallery_albums_id',
			'title'             => $this->__('Альбом'),
			'linkOptions'       => 'photogallery/admin-albums/index',
			'linkBindFields'    => array('photogallery_albums_id'),
			'width'             => '1%',
			'nowrap'            => 'nowrap',
			'filterable'        => 'true',
			'filterableType'    => Core_Block_Grid_Widget::FILTER_SELECT,
			'filterableOptions' => $this->getPhotogalleryAlbumsId(),
		));
		
		$this->setData(Core::getMapper('photogallery/images')->fetchAll());

		$this->addBlockChild(
			Core::getBlock('photogallery/admin-images/index/toolbar'),
			self::BLOCK_PLACEMENT_BEFORE
		);

		$this->addBlockChild(array(
			'blockName'       => 'photogallery/admin-images/index/pagination',
			'type'            => 'pagination',
			'totalItemsCount' => Core::getMapper('photogallery/images')->fetchCount(),
		), self::BLOCK_PLACEMENT_AFTER);
	}
	
	protected function _formatPhotogalleryAlbumsTree($collection, array $result = array(), $depth = 0)
	{
		foreach ($collection as $item) {
			$result[$item->getId()] = str_repeat('--', $depth) ." ". $item->getTitle();
			$result = $this->_formatPhotogalleryAlbumsTree($item->getChilds(), $result, $depth + 1);
		}
		
		return $result;
	}
	
	protected $_photogalleryAlbumsId;
	public function getPhotogalleryAlbumsId()
	{
		if (null === $this->_photogalleryAlbumsId) {
			$this->_photogalleryAlbumsId = $this->_formatPhotogalleryAlbumsTree(Core::getMapper('photogallery/albums')->fetchTree(), array('Нет'));
		}
		
		return $this->_photogalleryAlbumsId;
	}
}