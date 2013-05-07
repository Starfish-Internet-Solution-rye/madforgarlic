<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class commerceAjaxView extends applicationsSuperView
{
	//=================================================================================================	
	public function displayShoppingCartItems($shopping_cart)
	{
		$content ='';
		foreach ($shopping_cart->items as $item)
		{
		//	print "<pre>";
		//	var_dump($item->getObjectItem());
			//$product_title = $item->getObjectItem()->getProductTitle();
			$product_title ='';
			$content .= $product_title.' quantity:'.$item->quantity.'<br><br>';
		}
		return $content;
	}
	//=================================================================================================	

	
}
?>