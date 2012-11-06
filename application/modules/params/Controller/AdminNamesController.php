<?php

class Params_AdminNamesController extends Core_Controller_Action
{	
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Contents static posts');
		$this->getResponse()->appendBody(implode('<br />' ,$this->getHelper('FlashMessenger')->getMessages()));
	}
	
	public function indexAction(){}
    
    public function editAction()
    {
    	$id    = $this->getRequest()->getParam('id');
    	$model = Core::getMapper('params/names')->find($id);
    	
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
	    		$form = Core::getBlock('params/admin-names/edit');
	    		if (!$form->isValid($data)) {
	    			Core::getSession('admin')->formHasErrors = true;
	    			throw new Exception($this->__("Invalid form"));
	    		}
	    			
	    		$model = Core::getMapper('params/names')->create($form->getValues());
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
    
    public function deleteAction()
    {
    	$ids = $this->getRequest()->getParam('ids');
    	if (!is_array($ids)) {
    		$this->getHelper('FlashMessenger')->addMessage($this->__('Please select item(s)'));
    	} else {
    		try {
    			foreach ($ids as $id) {
    				$model = Core::getMapper('params/names')->find($id);
    				$model->delete();
    			}
    			
    			$this->getHelper('FlashMessenger')->addMessage(count($ids) . ' record(s) have been successfully deleted');
    		} catch (Exception $e) {
    			$this->getHelper('FlashMessenger')->addMessage($e->getMessage());
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
    }
    
    public function statusAction()
    {
        $ids = $this->getRequest()->getParam('ids');
    	if (!is_array($ids)) {
    		$this->getHelper('FlashMessenger')->addMessage($this->__('Please select item(s)'));
    	} else {
    		try {
    			foreach ($ids as $id) {
    				$model = Core::getMapper('params/names')->find($id);
    				$model->setEnabled($this->getRequest()->getParam('enabled'));
    				$model->save();
    			}
    			
    			$this->getHelper('FlashMessenger')->addMessage(count($ids) . ' record(s) have been successfully updated');
    		} catch (Exception $e) {
    			$this->getHelper('FlashMessenger')->addMessage($e->getMessage());
    		}
    	}
    	
    	$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
    }
}
