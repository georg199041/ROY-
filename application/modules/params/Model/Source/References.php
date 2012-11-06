<?php

class Params_Model_Source_References extends Core_Model_Source_DbTable
{
	public function install()
	{
		$file = __DIR__ . '/../../schema/' . $this->getName() . '.sql';
		if (file_exists($file)) {
			$this->getAdapter()->query(file_get_contents($file));
		}
	}
}