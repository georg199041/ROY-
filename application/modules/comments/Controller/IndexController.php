<?php

class Comments_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		$this->view->headTitle('Comments');
	}
	
	public function indexAction(){}
	
	public function commentsAction(){}
	
	public function addCommentAction()
	{
		if (($data = $this->getRequest()->getPost())) {
			try {
				$form = Core::getBlock('comments/index/add-comment');
				if (!$form->isValid($data)) {
					Core::getSession('front')->formHasErrors = true;
					throw new Exception('Invalid form');
				}
				
				$model = Core::getMapper('comments/comments')->create($form->getValues());
				$model->save();
				unset(Core::getSession('front')->formData);
				
				$form->reset();
			} catch (Exception $e) {
				Core::getSession('front')->formData = $data;
			}
		}
		
		$this->getHelper('Redirector')->gotoUrlAndExit($this->getRequest()->getParam('back_url'));
	}
}
