<?php

class Contents_Model_Entity_StaticPosts extends Core_Model_Entity_Abstract
{
	public function getCreatedTs()
	{
		return date('d.m.Y', $this->_data['created_ts']);
	}
}