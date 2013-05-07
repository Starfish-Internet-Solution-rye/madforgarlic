<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class deliveryAddressView extends applicationsSuperView
{
	private $deliveryAddress;
	
	public function showDeliveryAddressForm()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/deliveryAddress/deliveryAddress_form.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
	
	
}