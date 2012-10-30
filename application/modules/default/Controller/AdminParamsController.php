<?php

require_once "Core/Controller/Action.php";

class AdminParamsController extends Core_Controller_Action
{	
	public function init()
	{
		
	}
	
	public function indexAction()
    {
    	/*$list = Core::getInstance()->getMapper('default/params-types')->fetchAll();
    	
    	$toolbar = new Core_Block_Toolbar_Widjet();
    	echo $toolbar->setTitle('Grid')->addButton('button', 'save', array('title' => 'Save', 'urlOptions' => array('controller' => 'admin-params')))
    	->addLink('button', 'ref', array('title' => 'mod', 'urlOptions' => array('controller' => 'admin-params-references')));
    	
    	$grid = new Core_Block_Grid_Widjet();
    	$grid->setData($list->toArray());
    	$grid->addColumn('default', 'id', array('filterable' => true));
    	$grid->addColumn('literal', 'title', array('defaultLiteral' => '(не указано)', 'sortable' => true, 'filterable' => true));
    	$grid->addColumn('default', 'code', array('sortable' => true, 'filterable' => true));
    	$grid->addColumn('select', 'source_required', array('selectOptions' => array('YES' => 'YES', 'NO' => 'NO'), 'filterable' => true));
    	$grid->addColumn('select', 'enabled', array('selectOptions' => array('YES' => 'YES', 'NO' => 'NO'), 'filterable' => true));
    	
    	echo $grid;
    	//var_dump(Zend_Controller_Front::getInstance()->getRequest()->getParams());*/
    }
}
