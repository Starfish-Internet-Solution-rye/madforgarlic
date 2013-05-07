<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('mainModel.php');
require_once('mainView.php');

class mainController extends controllerSuperClass_Core
{
	
	public function getMainLayout()
	{
		require_once 'Project/Code/System/Settings/settings.php';
		$analytics = new settings();
		$analytics->selectGoogleAnalytics();
		
		$mainView = new mainView();  
		
		$mainView->setGoogleAnalytics($analytics->getGoogleAnalytics());
		
		$mainView->getMainLayout();
	}
}

?>