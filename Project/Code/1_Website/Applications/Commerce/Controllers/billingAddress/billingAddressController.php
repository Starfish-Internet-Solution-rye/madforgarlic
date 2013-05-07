<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'Project/Code/System/Accounts/addresses/address.php';
require_once 'billingAddressView.php';


class billingAddressController extends applicationsSuperController
{
	public function indexAction()
	{
		//are they registered on not?
		if(!authorization::areWeLoggedIn())
		{
			//we do it this way so that certain application classes can override the super Login action
			//make sure that the user is logged in
			globalRegistry::getInstance()->setRegistryValue('event','login_application_grabs_control','true');
			$this->doLogin();
		}
		else
		{
			
			//otherwise, show the list of billing addresses and a form if the user wants another billing address?
			//they are logged therefore we have the User ID contained in the session
			$user_id = authorization::getUserID(); 
			
			//if they do then show it to them, 
			
			if(isset($_POST['submit']))
				$this->submit();
			
			else
			{
				$checkoutView = new billingAddressView();
				$checkoutView->showBillingAddressForm();
			}		
		}
	}
	
	
	private function submit()
	{
		require_once 'Project/Code/1_Website/Applications/Commerce/Modules/billingAddress/billingAddressSession.php';
		//check details, save info over current delivery address
		
		//and if everything is okay go to ORDER SUMMARY
		//otherwise show form again with missing fields highlighted
		
		//if there's a new billing address and everything' validated, save the new address to the database
		// and save the chosen billing address using session or cookies
		//proceed to billing address
		$billing_address = new address();
		
		$billing_address->setStreetAddress('kj');
		$billing_address->setCity('jk');
		$billing_address->setState('OH');
		$billing_address->setZip('78798');
		$billing_address->setCountry('Philippines');
		$billing_address->setPhone('63212312345');
		$billing_address->setPhoneExtension('jhkj');
		$billing_address->setAddressType('billing');
		
		$billing_address_session = new billingAddressSession();
		$billing_address_session->saveBillingAddressSession($billing_address);
	
		header('Location:/eshop/order_summary');
	}
}