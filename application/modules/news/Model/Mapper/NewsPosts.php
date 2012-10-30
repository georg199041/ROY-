<?php

class News_Model_Mapper_NewsPosts extends Core_Model_Mapper_Abstract
{
	protected function _afterFetchAll(Core_Model_Collection_Abstract $collection)
	{
		$testUse = md5('test');
		
		$collection->each(function($value, $key) use ($testUse) {
			$value->setKey('---' . $key . '---' . $testUse);
		});
	}
}