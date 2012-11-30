<?php

class Default_Model_Mapper_Cache extends Core_Model_Mapper_Abstract
{
	public function fetchAll()
	{
		if (Zend_Registry::isRegistered('Zend_Cache_Manager')) {
			$manager = Zend_Registry::get('Zend_Cache_Manager');
		} else if (Zend_Controller_Action_HelperBroker::hasHelper('cache')) {
			$manager = Zend_Controller_Action_HelperBroker::getStaticHelper('cache')->getManager();
		}
		
		if ($manager instanceof Zend_Cache_Manager) {
			if (method_exists($manager, 'getCacheTemplates')) {
				$rows = $manager->getCaches();
			} else {
				$r = new Zend_Reflection_Class($manager);
				$p = $r->getProperty('_optionTemplates');
				$p->setAccessible(true);
				$rows = $p->getValue($manager);
			}
		} else {
			$rows = array();
		}
		
		$collection = $this->createCollection();		
		$this->_beforeFetchRows($collection);
		
		foreach ($rows as $id => $cache) {
			$entity = $this->create();
			//var_dump(method_exists($cache, 'getOption'));
			$entity->setId($id);
			$entity->setEnabled($cache->getOption('caching'));
			$entity->setLifetime($cache->getOption('lifetime'));
			
			$collection->push($entity);
		}
		
		$this->_afterFetchRows($collection);		
		return $collection;
	}
}