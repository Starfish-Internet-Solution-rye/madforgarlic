<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'searchModel.php';
require_once 'searchView.php';

require_once 'Project/Code/System/Products/categories.php';
require_once 'Project/Code/System/Products/category.php';
require_once 'Project/Code/System/Products/subcategories.php';

class searchController extends applicationsSuperController
{
	public function indexAction()
	{	
		$model = new searchModel();
		$model->selectSearch('', '', '', '', '', '');

		$view = new searchView();
		$view->setArrayOfResults($model->getArrayOfResults());
		$view->displaySearchContentColumn();
	}
	
	public function resultsAction()
	{
		if(isset($_POST['search']))
		{	
			$model = new searchModel();
			$model->selectSearch($_POST['product_title'], $_POST['description'], $_POST['category_id'],
				$_POST['subcategory_id'], $_POST['date_from'], $_POST['date_to']);

			$view = new searchView();
			$view->setArrayOfResults($model->getArrayOfResults());
			$view->displaySearchContentColumn();
		}
		
		else
			$this->indexAction();
	}
}


