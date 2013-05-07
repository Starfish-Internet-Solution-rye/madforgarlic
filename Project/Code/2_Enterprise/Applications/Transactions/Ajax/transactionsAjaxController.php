<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';;

class transactionsAjaxController extends applicationsSuperController
{
	public function load_subcategoryAction()
	{
		require_once 'Project/Code/2_Enterprise/Applications/Products/Blocks/productsBlockController.php';
		
		$productsBlockController  = new productsBlockController();
		
		jQuery('#subcategory_list')->html($productsBlockController->getSubCategoryList($_REQUEST['category_id']));
		
		jQuery::getResponse();
	}
	
}