<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'Project/Code/System/Accounts/addresses/address.php';
require_once 'deliveryAddressView.php';

class deliveryAddressController extends applicationsSuperController
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
			//they are logged in therefore we have the User ID contained in the session
			$user_id = authorization::getUserID(); 
			

			//show list of delivery addresses
			//or maybe add another using a form
			
			if(isset($_POST['submit']))
				$this->submit();
			
			else
			{
				$deliveryAddressView = new deliveryAddressView();
				$deliveryAddressView->showDeliveryAddressForm();
			}
		}
	}
	
	private function submit()
	{
		require_once 'Project/Code/1_Website/Applications/Commerce/Modules/deliveryAddress/deliveryAddressSession.php';
		//check details, save info over current delivery address
		
		//and if everything is okay go to billing address
		//otherwise show form again with missing fields highlighted
		
		// save the delivery address to the database
		//save delivery addresss in session/cookie
		//proceed to delivery options
		
		//test delivery address
		$delivery_address = new address();
		
		$delivery_address->setStreetAddress('q');
		$delivery_address->setCity('q');
		$delivery_address->setState('OH');
		$delivery_address->setZip('34234');
		$delivery_address->setCountry('Philippines');
		$delivery_address->setPhone('63212312345');
		$delivery_address->setPhoneExtension('q');
		$delivery_address->setAddressType('delivery');
		
		
		$delivery_address_session = new deliveryAddressSession();
		$delivery_address_session->saveDeliveryAddressSession($delivery_address);
		
		header('Location:/eshop/delivery_options');
	}
}