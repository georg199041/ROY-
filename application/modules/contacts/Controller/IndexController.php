<?php

class Contacts_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('google');
	}
	
	public function indexAction(){}
}
