<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class receiptView extends applicationsSuperView
{
	public $receipt;
	
	public function displayReceiptTemplate()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/receipt/receipt.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
}