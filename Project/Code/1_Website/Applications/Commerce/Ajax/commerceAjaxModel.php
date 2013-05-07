<?php
require_once 'Project/Code/System/Products/products.php';

class commerceAjaxModel 
{
	//used by shopping cart controller line 56!
	public function getProductDetails($product_id)
	{
		$product = new products();
		$product->select();
		return $product;
	}
	
	
}
?>