<?php

class News_Model_Entity_NewsPosts extends Core_Model_Entity_Abstract
{
	public function getCreatedTs()
	{
		return date('d.m.Y', $this->_data['created_ts']);
	}
}