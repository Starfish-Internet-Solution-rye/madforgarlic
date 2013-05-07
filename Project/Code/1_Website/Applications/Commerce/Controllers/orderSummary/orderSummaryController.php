<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'orderSummaryView.php';
require_once 'orderSummaryModel.php';

class orderSummaryController extends applicationsSuperController
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
			require_once 'Project/Code/1_Website/Applications/Commerce/Modules/deliveryAddress/deliveryAddressSession.php';
			require_once 'Project/Code/1_Website/Applications/Commerce/Modules/deliveryOptions/deliveryOptionSession.php';
			require_once 'Project/Code/1_Website/Applications/Commerce/Modules/billingAddress/billingAddressSession.php';
			require_once 'Project/Code/1_Website/Applications/Commerce/Modules/shoppingCart/shoppingCartController.php';
			
			$user_id = authorization::getUserID();
			//get delivery address billing address and shopping cart
			//if user wants to continue shopping, redirect user to last viewed product
			//otherwise, proceed to checkout
		
			$shoppingCartController = new shoppingCartController();
			$delivery_address_session = new deliveryAddressSession();
			$delivery_option_session = new deliveryOptionSession();
			$billing_address_session = new billingAddressSession();
			
			$delivery_address = $delivery_address_session->getDeliveryAddress();
			$shopping_cart = $shoppingCartController->getShoppingCart();
			$delivery_option = $delivery_option_session->getDeliveryOption();
			$billing_address = $billing_address_session->getBillingAddress();
			
			$orderSummaryView = new orderSummaryView();
			$orderSummaryView->showOrderSummaryForm($delivery_address, $billing_address, $shopping_cart);
			
		}
	}
	
	public function checkDetailsAction()
	{
		//check details, save info over current delivery address
		
		//and if everything is okay go to billing address
		//otherwise show form again with missing fields highlighted
		
		
		//note: we may not need the payment controller if we use a third party payment thing...
		//user is redirected to 2checkout
		header('Location:/eshop/payment');
	}
	
	
}