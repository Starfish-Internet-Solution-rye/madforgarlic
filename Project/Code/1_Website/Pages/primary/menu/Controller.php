<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$view = new view();
		$view->displayPageNavigation();
		$view->getjScrollPane();
		
		$model = new model();
		
		$url_parameter = routes::getInstance()->_pathInfoArray;
		
		if(count($url_parameter) >= 2){
			$XML = $model->loadDataSimpleXML($url_parameter[1]);
		}
		else
			$XML = $model->loadDataSimpleXML('data');
		
		$view->_XMLObj = $XML;
		$view->renderAll();
	}
}
?>