<?php

class Application_Block_Default_Header extends Core_Block_View
{
	public function getContactsGroups()
	{
		if (null === $this->_groups) {
			$this->_groups = Core::getMapper('contacts/groups')->fetchAll(array(
				'enabled = ?' => 'YES'
			));
		}
		
		return $this->_groups;
	}
	
	public function getContacts()
	{
		$groups = Core::getMapper('contacts/groups')->fetchAll(array(
			'enabled = ?' => 'YES'
		));
		
		$groups->each(function($value, $key) {
			$contacts = Core::getMapper('contacts/contacts')->fetchAll(array(
				'enabled = ?' => 'YES',
				'contacts_groups_id = ?' => $value->getId(),
			));
			
			$value->setChilds($contacts);
		});
		
		var_export($groups->toArray());
		return $groups;
	}
	
	protected $_mainUkraineTelephone;
	
	public function getMainUkraineTelephone()
	{
		if (null === $this->_mainUkraineTelephone) {	
			$group = Core::getMapper('contacts/groups')->fetchRow(array(
				'enabled = ?' => 'YES',
				'alias = ?' => 'crimea_base'
			));
				
			$phone = Core::getMapper('contacts/contacts')->fetchRow(array(
				'enabled = ?' => 'YES',
				'contacts_groups_id = ?' => $group->getId() || null,
				'alias = ?' => 'main_phone'
			));
			
			$this->_mainUkraineTelephone = $phone;
		}
		
		return $this->_mainUkraineTelephone;
	}
	
	protected $_moscowAddress;
	
	public function getMoscowAddress()
	{
		if (null === $this->_moscowAddress) {
			$group = Core::getMapper('contacts/groups')->fetchRow(array(
				'enabled = ?' => 'YES',
				'alias = ?' => 'moscow_office'
			));
		
			$phone = Core::getMapper('contacts/contacts')->fetchAll(array(
				'enabled = ?' => 'YES',
				'contacts_groups_id = ?' => $group->getId() || null,
			));
				
			$this->_moscowAddress = $phone;
		}
		
		return $this->_moscowAddress;
	}
	
	
	
	public function getContactsGroups()
	{
		$groups = Core::getMapper('contacts/groups')->fetchAll(array(
			'enabled = ?' => 'YES'
		));
		
		return $groups;
	}
	
	// TODO:
	// get moscow addres and phone
	public function getMoscowAddress()
	{
		// find parent
		// find by alias and parent
	}
	
	public function getMoscowAddress()
	{
		// find parent
		// find by alias and parent
	}
	
	// get ukraine phone
	public function getCrimeaBaseMainPhone()
	{
		
	}
}