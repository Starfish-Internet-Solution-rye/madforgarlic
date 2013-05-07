<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'productsView.php';
require_once 'productsModel.php';

require_once 'Project/Code/System/Products/category.php';
require_once 'Project/Code/System/Products/subcategories.php';
require_once 'Project/Code/System/Products/product.php';
require_once 'Project/Code/System/Products/products.php';
require_once 'Project/Code/System/Routes/route.php';


class productsController extends applicationsSuperController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function indexAction()
	{	
		$url_parameters = routes::getInstance()->_pathInfoArray;
		
		//if permalink exists
		if(globalRegistry::getInstance()->getRegistryValue('event','permalink_exists') == 'true')
			$this->detailsAction($url_parameters[0]);
		
		else
		{
			array_shift($url_parameters);
			
			if(count($url_parameters) == 1)
				$this->categoryAction($url_parameters[0]);
		
			elseif(count($url_parameters) == 2)
				$this->subcategoryAction($url_parameters[0]);
			
			else
			{
				$products = new products();
				$products->select();
				
				$productsView = new productsView();
				$productsView->setArrayOfProducts($products->getArrayOfProducts());
				$productsView->displayProductListing();
			}
		}
		$productsView->displayMain_layout();
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function detailsAction($permalink)
	{	
		$product	= new product();
		
		if($permalink !== NULL)
		{
			$product->setPermalink($permalink);
			$product->select();
			
			$productsView = new productsView();
			$productsView->setProduct($product);
			$productsView->displayProductDetails();
		}
		else
			header('Location: /products');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function categoryAction($category_title)
	{	
		$products	= new products();
		
		if($category_title !== NULL)
		{
			//get category id using category title
			$category = new category();
			$category->setCategoryTitle($category_title);
			$category->selectByTitle();
			
			//select subcategories by category id
			$subcategories = new subcategories();
			$subcategories->selectByCategoryID($category->getCategoryID());
			
			//select product by category id
			$products->setCategoryID($category->getCategoryID());
			$products->selectByCategoryID();
			
			//pass products and subcategories to view
			$productsView = new productsView();
			$productsView->setArrayOfSubCategories($subcategories->getArrayOfSubcategories());
			$productsView->setArrayOfProducts($products->getArrayOfProducts());
			$productsView->displayProductListing();
		}
		
		else
			header('Location: /products');
	}
	
	
}