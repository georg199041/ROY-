<?php

class Default_Model_Source_Cache extends Core_Model_Source_DbTable
{
	protected $_cacheManager;
	
	public function setCacheManager(Zend_Cache_Manager $manager)
	{
		$this->_cacheManager = $manager;
		return $this;
	}
	
	public function getCacheManager()
	{
		if (null === $this->_cacheManager) {
			if (Zend_Registry::isRegistered('Zend_Cache_Manager')) {
				$this->setCacheManager(Zend_Registry::get('Zend_Cache_Manager'));
			} else if (Zend_Controller_Action_HelperBroker::hasHelper('cache')) {
				$this->setCacheManager(Zend_Controller_Action_HelperBroker::getStaticHelper('cache')->getManager());
			} else {
				$this->_cacheManager = false; // Prevent retry processing
			}
		}
	
		return $this->_cacheManager;
	}
	
	public function fetchAll()
	{
		if ($this->getCacheManager() instanceof Zend_Cache_Manager) {
			if (method_exists($this->getCacheManager(), 'getCacheTemplates')) {
				return $this->getCacheManager()->getCaches();
			}
			
			$r = new Zend_Reflection_Class($this->getCacheManager());
			$p = $r->getProperty('_optionTemplates');
			$p->setAccessible(true);
			return $p->getValue($manager);
		}

		return array();
	}
}