<?php
require_once 'Project/Code/'.DOMAIN.'/Applications/Commerce/Modules/shoppingCart/shoppingCartController.php';
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'showCartView.php';
require_once 'showCartModel.php';


class showCartController extends applicationsSuperController
{

	public function indexAction()
	{
		$shoppingCartController = new shoppingCartController();
		$shoppingCart = $shoppingCartController->getShoppingCart();
		
		$showCartView = new showCartView();
		$showCartView->displayShoppingCart($shoppingCart);
		
		
	}
	
	
	
}