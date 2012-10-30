<?php

require_once "Core/Controller/Action.php";

class Default_IndexController extends Core_Controller_Action
{	
	public function init()
	{
		
	}
	
	public function indexAction()
    {
		//new Default_Controller_Plugin_Grid();
		//new Application_Controller_Plugin_Editor();
		//$image = Core_Image::load('uploads/jquery-php.gif');
		/*require_once "Core/Model/Collection/Abstract.php";
		$collection = new Core_Model_Collection_Abstract(array('one', 'two', 'three'));
		
		$collection->each(function(&$value, $index){
			$value = "<b>$value</b>";
			//echo $value;
		});

		$collection->each(function($value, $index){
			echo "<div>$value</div>";
		});
		echo 'before cache';
		var_export($collection);
		*/
    	
    	//$mapper = new Default_Model_Mapper_OnecStudents();
    	//$test1 = $mapper->fetchAll(null, null, 500);
    	/*foreach($test1 as $i){
    		echo "<div>{$i->getTitle()}</div>";
    	}*/
    	//echo "<div><b>" . count($test1) . "</b></div>";
    	
    	//$test2 = $mapper->fetchAll(null, null, 500);
    	/*foreach($test2 as $i){
    		echo "<div>{$i->getTitle()}</div>";
    	}*/
    	//echo "<div><b>" . count($test2) . "</b></div>";
    	//echo 1;
    	$block = new Default_Block_Index_Edit();
    	echo $block;
    }
}
