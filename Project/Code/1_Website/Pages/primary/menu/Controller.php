<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$view = new view();
		$view->getjScrollPane();
		
		$model = new model();
		
		$url_parameter = routes::getInstance()->_pathInfoArray;
		
		if(count($url_parameter) >= 2){
			$XML = $model->loadDataSimpleXML($url_parameter[1]);
		}
		else
			$XML = $model->loadDataSimpleXML('data');
		
		$view->_XMLObj = $XML;
		$view->displayPageNavigation();
		$view->renderAll();
	}
		
		
	public function downloadmenuAction()
	{
		
		$orig_filename = $_GET['filename'];
	
		$explode = explode('.', $orig_filename);
		$ext = $explode[count($explode) - 1];
		
		$path = "Data/pdf/";
		
		//load the endcoded path and let the user download it with the original filename.
		header('Content-type: '.$ext);
		header('Content-Disposition: attachment; filename="'.$orig_filename.'"');
		readfile($path.$_GET['path'].".".$ext);
		
		//die is used here so that it stops the execution of the framework
		die;
	}
}
?>