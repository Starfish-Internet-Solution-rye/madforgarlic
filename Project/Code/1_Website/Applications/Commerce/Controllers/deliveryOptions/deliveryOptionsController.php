<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'deliveryOptionsView.php';

class deliveryOptionsController extends applicationsSuperController
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
		else
		{
			if(isset($_POST['submit']))
				$this->submit();
			
			else
			{
				//form for delivery options
				$deliveryOptionsView = new deliveryOptionsView();
				$deliveryOptionsView->showDeliveryOptionsForm();
			}
		}
	}
	
	private function submit()
	{
		require_once 'Project/Code/1_Website/Applications/Commerce/Modules/deliveryOptions/deliveryOptionSession.php';
		//check details, save info over current delivery address
		
		//and if everything is okay go to billing address
		//otherwise show form again with missing fields highlighted
		//save delivery option in session
		
		$delivery_option_session = new deliveryOptionSession();
		$delivery_option_session->saveDeliveryOptionSession('LBC');
		
		header('Location:/eshop/billing');
	}
}