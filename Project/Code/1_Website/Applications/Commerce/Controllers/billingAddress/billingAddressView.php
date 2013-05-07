<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class billingAddressView extends applicationsSuperView
{
	public function showBillingAddressForm()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/billingAddress/billingAddress_form.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
}