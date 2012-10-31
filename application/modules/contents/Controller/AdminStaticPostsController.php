<?php

require_once "Core/Controller/Action.php";

class Contents_AdminStaticPostsController extends Core_Controller_Action
{	
	public function init()
	{
    	$this->getResponse()->appendBody(implode('<br />' ,$this->getHelper('FlashMessenger')->getMessages()));
	}
	
	public function indexAction()
    {}
    
    public function editAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('contents/static-posts')->find($id);
    	
    	if ($model || $id == 0) {
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
	    		$form = Core::getBlock('contents/admin-static-posts/edit');
	    		if (!$form->isValid($data)) {
	    			throw new Exception(var_export($form->getErrors(), true));
	    		}
	    			
	    		$model = Core::getMapper('contents/static-posts')->create($form->getValues());
	    		$model->save();
	    		
	    		unset(Core::getSession('admin')->formData);
	    		$this->getHelper('FlashMessenger')->addMessage($this->__('Saved success'));
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
