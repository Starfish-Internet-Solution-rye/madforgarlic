<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class paymentsView extends applicationsSuperView
{
	private $templates_location;
	
	public function __construct()
	{
		$this->templates_location = 'Project/Design/2_Enterprise/Applications/Transactions/Controllers/templates/payments/';
	}
	 
//=================================================================================================

	public function displayPaymentsContentColumn()
	{
		$this->displayPaymentsHeader();
		
		$content = $this->renderTemplate($this->templates_location.'payments_content_column.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
	 
//=================================================================================================

	private function displayPaymentsHeader()
	{
		$content = $this->renderTemplate($this->templates_location.'payments_header.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_HEADER'=>$content));
	}
	 
}


