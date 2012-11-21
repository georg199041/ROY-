<?php

class Default_AdminIndexController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->getResponse()->appendBody('<div>' . implode('<br />' ,$this->getHelper('FlashMessenger')->getMessages()) . '</div>');
	}
	
	public function indexAction(){}
}