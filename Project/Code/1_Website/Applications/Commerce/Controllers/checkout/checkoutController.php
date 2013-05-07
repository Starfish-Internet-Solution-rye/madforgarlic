<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'checkoutView.php';
require_once 'checkoutModel.php';


class checkoutController extends applicationsSuperController
{

	public function indexAction()
	{

		//are they registered on not?
		
		if(!authorization::areWeLoggedIn())
		{
			//we do it this way so that certain applicatiob classes can override the super Login action
			globalRegistry::getInstance()->setRegistryValue('event','login_application_grabs_control','true');
			$this->doLogin();
		}
		
		
				
	}
	
	
}