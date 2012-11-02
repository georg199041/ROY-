<?php

class Contents_Block_AdminStaticPosts_Index_Toolbar extends Core_Block_Toolbar_Widget
{
	public function init()
	{
		$this->setTitle($this->__('Manage static posts'));
		
		$this->addButton(array(
			'name'  => 'show',
			'title' => $this->__('Show'),
			'urlOptions' => '*/*/status/enabled/YES'
		));
		
		$this->addButton(array(
			'name'  => 'hide',
			'title' => $this->__('Hide'),
			'urlOptions' => '*/*/status/enabled/NO'
		));
		
		$this->addButton(array(
			'name'  => 'delete',
			'title' => $this->__('Delete'),
			'urlOptions' => '*/*/delete'
		));
		
		$this->addButton(array(
			'name'  => 'add',
			'title' => $this->__('Add'),
			'urlOptions' => '*/*/edit'
		));
	}
}