<?php

class Photogallery_Model_Entity_Images extends Core_Model_Entity_Abstract
{
	public function getIcon104x70()
	{
		if (!Zend_Registry::isRegistered('Zend_Cache_Manager')) {
			return;
		}
		
		$cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('Recomendations');
		if (!$cache) {
			return;
		}
		
		$source = $this->getImage();
		if ($cache->test($source)) {
			return $cache->load($source);
		} else {
			return $cache->save($source);
		}
	}
	
	public function getBigImage570()
	{
		if (!Zend_Registry::isRegistered('Zend_Cache_Manager')) {
			return;
		}
		
		$cache = Zend_Registry::get('Zend_Cache_Manager')->getCache('Recomendations2');
		if (!$cache) {
			return;
		}
		
		$source = $this->getImage();
		if ($cache->test($source)) {
			return $cache->load($source);
		} else {
			return $cache->save($source);
		}
	}
}