<?php

class Users_Model_Entity_Users extends Core_Model_Entity_Abstract
{
	public function getRegisterTs()
	{
		return date('d.m.Y H:m', $this->_data['register_ts']);
	}
}