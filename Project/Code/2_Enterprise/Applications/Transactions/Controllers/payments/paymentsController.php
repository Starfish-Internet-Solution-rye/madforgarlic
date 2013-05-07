<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'paymentsView.php';

require_once 'Project/Code/System/Payments/payments.php';

class paymentsController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new paymentsView();
		$view->displayPaymentsContentColumn();
	}
	
	public function deleteAction()
	{
		if(isset($_POST['btnDelete']))
		{
			$payments = new payments();
			$payments->delete($_POST['payment_ids']);
		}
		
		header('Location: /transactions');
	}
}


