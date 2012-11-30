<?php

class Default_AdminCacheController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Управление кешем');
	}
	
	public function indexAction(){}
}