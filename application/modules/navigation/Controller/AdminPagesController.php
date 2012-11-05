<?php

class Navigation_AdminPagesController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Navigation pages');
		$this->getResponse()->appendBody(implode('<br />' ,$this->getHelper('FlashMessenger')->getMessages()));
	}
	
	public function indexAction()
	{
		new Navigation_Controller_Plugin_Navigation();
	}
    
    public function editAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('navigation/pages')->find($id);
    	
    	if ($model->getId() || $id == 0) {
    		Zend_Registry::set('form_data', $model);
    		return;
    	}
    	
    	$this->getHelper('FlashMessenger')->addMessage($this->__('Item does not exist'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function saveAction()
    {
    	if ($data = $this->getRequest()->getPost()) {
    		try {
	    		$form = Core::getBlock('navigation/admin-pages/edit');
	    		if (!$form->isValid($data)) {
	    			Core::getSession('admin')->formHasErrors = true;
	    			throw new Exception($this->__("Invalid form"));
	    		}
	    			
	    		$model = Core::getMapper('navigation/pages')->create($form->getValues());
    			if (!$this->getRequest()->getParam('navigation_pages_id')) {
	    			$model->setNavigationPagesId(null);
	    		}
	    		
	    		$model->save();	    		
	    		unset(Core::getSession('admin')->formData);
	    		
	    		$this->getHelper('FlashMessenger')->addMessage($this->__('Saved success'));
	    		if ($this->getRequest()->getParam('back')) {
	    			$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $model->getId()));
	    		}
	    		
	    		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
	    		return;
    		} catch (Exception $e) {
		    	Core::getSession('admin')->formData = $data;
		    	$this->getHelper('FlashMessenger')->addMessage($this->__($e->getMessage()));
		    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/edit/id/' . $this->getRequest()->getParam('id')));
		    	return;
    		}
    	}
    	
    	$this->getHelper('FlashMessenger')->addMessage($this->__('Unable to find item to save'));
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
}
