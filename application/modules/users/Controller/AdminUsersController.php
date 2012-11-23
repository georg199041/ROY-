<?php

class Users_AdminUsersController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Пользователи');
	}
	
	public function indexAction(){}

	public function editAction()
	{
		$id    = $this->getRequest()->getParam('id');
		$model = Core::getMapper('users/users')->find($id);
		 
		if ($model->getId() || $id == 0) {
			Zend_Registry::set('form_data', $model);
			return;
		}
		 
		Core::getBlock('application/admin/messenger')->addError($this->__('Запись не найдена'));
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'));
	}
	
	public function saveAction()
	{
		if ($this->getRequest()->isPost()) {
			try {
				$form = Core::getForm('users/edit');
				if (!$form->isValid($this->getRequest()->getParams())) {
					$this->getHelper('FlashMessenger')->addMessage('Error saving item: ' . $form->getErrors());
					$this->getHelper('Redirector')->gotoRoute(array('action' => 'edit'));
					return;
				}
				
				$model = Core::getMapper('users/users')->create($form->getValues());
				Core::getMapper('users/users')->save($model);
				
				if (!$this->getRequest()->getParam('id')) {
					$this->getHelper('FlashMessenger')->addSuccess('Success added');
				} else {
					$this->getHelper('FlashMessenger')->addSuccess('Success saved');
				}
				
				if ($this->getRequest()->getParam('apply')) {
					$this->getHelper('Redirector')->gotoRoute(array('action' => 'edit', 'id' => $model->getId()));
				}
				
				$this->getHelper('Redirector')->gotoRoute(array('action' => 'index'));
				return;
			} catch (Exception $e) {
				$this->getHelper('FlashMessenger')->addMessage('Error saving item: ' . $e->getMessage());
				$this->getHelper('Redirector')->gotoRoute(array('action' => 'edit', 'id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		
		$this->getHelper('FlashMessenger')->addMessage('Unable to find post to save');
		$this->getHelper('Redirector')->gotoRoute(array('action' => 'index'));
	}
	
	public function blockAction()
	{
		$id = $this->getRequest()->getParam('id');
		if (!is_array($id)) {
			$this->getHelper('FlashMessenger')->addMessage('Please select post(s)');
		} else {
			try {
				foreach ($id as $i) {
					$model = Core::getMapper('users/users')->find($i);
					$model->setBlock($this->getRequest()->getParam('block'));
					Core::getMapper('users/users')->save($model);
				}
				
				$this->getHelper('FlashMessenger')->addMessage(sprintf('Total of %d record(s) were successfully updated', count($id)));
			} catch (Exception $e) {
				$this->getHelper('FlashMessenger')->addMessage('Error: ' . $e->getMessage());
			}
		}
		
		$this->getHelper('Redirector')->gotoRoute(array('action' => 'index'));
	}
	
	public function cancelAction()
	{
		if ($this->getRequest()->getParam('id')) {
			try {
				$model = Core::getMapper('users/users')->find($this->getRequest()->getParam('id'));
				$model->setCheckedOut(0);
				$model->setCheckedOutTime(0);
				Core::getMapper('users/users')->save($model);
			} catch (Exception $e) {
				$this->getHelper('FlashMessenger')->addMessage('Error update item: ' . $e->getMessage());
				$this->getHelper('Redirector')->gotoRoute(array('action' => 'edit', 'id' => $this->getRequest()->getParam('id')));
			}
		}
		
		$this->getHelper('Redirector')->gotoRoute(array('action' => 'index'));
	}
	
	public function deleteAction()
	{
		$id = $this->getRequest()->getParam('id');
		if (!is_array($id)) {
			$this->getHelper('FlashMessenger')->addMessage('Please select post(s)');
		} else {
			try {
				foreach ($id as $i) {
					$model = Core::getMapper('users/users')->find($i);
					Core::getMapper('users/users')->delete($model);
				}
		
				$this->getHelper('FlashMessenger')->addMessage(sprintf('Total of %d record(s) were successfully deleted', count($id)));
			} catch (Exception $e) {
				$this->getHelper('FlashMessenger')->addMessage('Error: ' . $e->getMessage());
			}
		}
		
		$this->getHelper('Redirector')->gotoRoute(array('action' => 'index'));
	}
	
	public function newAction()
	{
		$id = $this->getRequest()->getParam('id'); // WARNING !!! This is parent id
	}
	
	public function logoutAction()
	{
		
	}
}