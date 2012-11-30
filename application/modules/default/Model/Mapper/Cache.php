<?php

class Default_Model_Mapper_Cache extends Core_Model_Mapper_Abstract
{
	public function fetchAll()
	{
		$collection = $this->createCollection();		
		$this->_beforeFetchRows($collection);
		
		$rowset = $this->getSource()->fetchAll();
		foreach ($rowset as $id => $cache) {
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