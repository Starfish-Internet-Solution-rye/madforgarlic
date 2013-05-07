<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class productsView extends applicationsSuperView
{
	private $product;
	private $array_of_products = array();
	private $array_of_subcategories = array();
	
//=================================================================================================

	public function getProduct() { return $this->product; }
	
//=================================================================================================

	public function getArrayOfProducts() { return $this->array_of_products; }
	
//=================================================================================================

	public function getArrayOfSubcategories() { return $this->array_of_subcategories; }
	
//=================================================================================================

	public function setProduct($product) { $this->product = $product; }
	
//=================================================================================================

	public function setArrayOfProducts($array_of_products) { $this->array_of_products = $array_of_products; }
	
//=================================================================================================

	public function setArrayOfSubcategories($array_of_subcategories) { $this->array_of_subcategories = $array_of_subcategories; }
	
//=================================================================================================

	public function displayMain_layout()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Products/Controllers/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('PRUDUCTS CSS JS LINK'=>$content));
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Products/Controllers/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
	public function displayProductListing()
	{	
		require_once 'Project/Code/System/Products/product_image.php';
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Products/Controllers/templates/products_listing.phtml');
		response::getInstance()->addContentToTree(array('PROJECT_CONTENT'=>$content));
	}
	
//=================================================================================================

	public function displayProductDetails()
	{
		/* $this->addToShoppingCartLink($this->product);
		
		$this->shoppingCartDropDownBoxHolder(); */
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Products/Controllers/templates/product_details.phtml');
		response::getInstance()->addContentToTree(array('PROJECT_CONTENT'=>$content));
	}
	

}