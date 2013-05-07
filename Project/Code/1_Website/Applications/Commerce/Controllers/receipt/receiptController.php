<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'receiptView.php';
require_once 'receiptModel.php';


class receiptController extends applicationsSuperController
{
	public function indexAction()
	{
		//if we use 2checkout, we'll just have to redirect the end of the payment process to this page
		//it will send payment details using POST
		//show the user the completed transaction
		//user will confirm the transaction details
		//then we'll save the payment details to the database
		//voila! we're done!
		
		$view = new receiptView();
		$view->receipt = $_POST;
		$view->displayReceiptTemplate();
	}
	
}