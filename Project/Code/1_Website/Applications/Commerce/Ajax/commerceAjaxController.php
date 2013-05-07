<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/'.DOMAIN.'/Applications/Commerce/Modules/shoppingCart/shoppingCartController.php';
require_once 'commerceAjaxModel.php';
require_once 'commerceAjaxView.php';
//----------------------------------------------------------

class commerceAjaxController extends applicationsSuperController
{
	 public function addProductToShoppingCartAction()
	 {
	 	//called from a Block
	 	//i just put in some hard coded details to see if shopping cart works
	 	
	 		$product_id = $_GET['product_id'];
	 	
	 	
	 		$commerceAjaxModel = new commerceAjaxModel();
	 		 
	 		$product = $commerceAjaxModel->getProductDetails($product_id);
	 		
	 		$shoppingCartItem = new shoppingCartItem($product_id);
	 		$shoppingCartItem->setQuantity(1);
	 		$shoppingCartItem->price = 1000;
	 		$shoppingCartItem->product_price = 1000;
	 		$shoppingCartItem->product_title = 'yo';
	 		$shoppingCartItem->description = 'test';
	 		$shoppingCartItem->category_id = '1';
	 		
	 		$shoppingCartController = new shoppingCartController();
	 		
	 		$shoppingCart = $shoppingCartController->getShoppingCart();
	 		$shoppingCart->addItem($shoppingCartItem);
	 	
	 		$commerceAjaxView = new commerceAjaxView();
	 		$content = $commerceAjaxView->displayShoppingCartItems($shoppingCart);
	 		//var_dump($shoppingCart);
	 	
	 		$numberOfItems = $shoppingCart->getNumberOfItems(true);
	 		$totalPrice = '<BR><BR>TOTAL: '.$shoppingCart->getTotalPrice().'PHP';
	 		$content .= $totalPrice;
	 		
	 		$shoppingCartController->saveShoppingCartSession($shoppingCart);
	 	
	 		jQuery('span#numberOfItems')->html($numberOfItems);
	 		jQuery('div#shoppingCartDropDown')->html($content);
	 		jQuery::getResponse();
	 	}
	 	
	 	public function changeItemQuantityAction()
	 	{
	 		//called from showCart
	 		 
	 		$product_id = $_GET['product_id'];
	 		$quantity = $_GET['quantity'];
	 		 
	 		$shoppingCartController = new shoppingCartController();
	 		$shoppingCart = $shoppingCartController->getShoppingCart();
	 		$shoppingCart->changeQuantity($product_id,$quantity);
	 		
	 		
	 		if ($quantity == 0) {
	 			jQuery('#quantity_div_'.$product_id)->hide('slow');
	 			$shoppingCart->deleteItem($product_id);
	 		}
	 		 
	 		//The shopping cart Icon total
	 		$shoppingCartController->saveShoppingCartSession($shoppingCart);
	 		$numberOfItems = $shoppingCart->getNumberOfItems(true);
	 		
	 		jQuery('span#numberOfItems')->html($numberOfItems);
	 		 
	 		$totalPrice = $shoppingCart->getTotalPrice();
	 		jQuery('#totalPrice')->html($totalPrice);
	 		jQuery::getResponse();
	 	
	 	}
	 	
	 	public function removeProductFromShoppingCartAction()
	 	{
	 		//called from showCart
	 		 
	 		$product_id = $_GET['product_id'];
	 		
	 		$shoppingCartController = new shoppingCartController();
	 		$shoppingCart = $shoppingCartController->getShoppingCart();
	 		$shoppingCart->deleteItem($product_id);
	 		 
	 		$totalPrice = $shoppingCart->getTotalPrice();
	 		jQuery('#totalPrice')->html($totalPrice);
	 		$numberOfItems = $shoppingCart->getNumberOfItems(true);
	 		jQuery('span#numberOfItems')->html($numberOfItems);
	 		 
	 		$shoppingCartController->saveShoppingCartSession($shoppingCart);
	 		jQuery::getResponse();
	 	
	 	}
	 	
	 
	 
	 
	 //===============================================================================================================================
	
	 
}