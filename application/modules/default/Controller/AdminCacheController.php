<?php

class Default_AdminCacheController extends Core_Controller_Action
{
	public function init()
	{
		$this->getHelper('layout')->setLayout('admin');
		$this->view->headTitle('Управление кешем');
	}
	
	public function indexAction(){}
	
	public function enabledAction()
	{
		$ids = $this->getRequest()->getParam('ids');
		if (!is_array($ids) && null !== $ids) {
			$ids = array($ids => 1);
			$this->getRequest()->setParam('value', $this->getRequest()->getParam('value') == 'YES' ? 'NO' : 'YES');
		}
	
		if (null === $ids) {
			Core::getBlock('application/admin/messenger')->addError($this->__('Не выбрана ни одна запись'));
		} else {
			try {
				foreach ($ids as $id => $selected) {
					if ($selected) {
						$model = Core::getMapper('default/cache')->find($id);
						$model->setEnabled($this->getRequest()->getParam('value'));
						$model->save();
					}
				}
				 
				$message = $this->getRequest()->getParam('value') == 'YES' ? 'Включено' : 'Выключено';
				Core::getBlock('application/admin/messenger')->addSuccess($this->__($message . ' записей:') . ' ' . count($ids));
			} catch (Exception $e) {
				$message = $this->getRequest()->getParam('value') == 'YES' ? 'включения' : 'выключения';
				Core::getBlock('application/admin/messenger')->addError($this->__('Ошибка ' . $message));
			}
		}
		 
		$this->getHelper('Redirector')->gotoRouteAndExit(Core::urlToOptions('*/*/index'), null, true);
	}
}