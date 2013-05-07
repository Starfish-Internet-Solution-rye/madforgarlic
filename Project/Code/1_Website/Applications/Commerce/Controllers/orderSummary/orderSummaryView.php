<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class orderSummaryView extends applicationsSuperView
{
	
	public $deliveryAddress;
	public $billingAddress;
	public $shoppingCart;
	
	public function showOrderSummaryForm($deliveryAddress,$billingAddress,$shoppingCart)
	{
		$this->deliveryAddress = $deliveryAddress;
		$this->billingAddress = $billingAddress;
		$this->shoppingCart = $shoppingCart;
	
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/orderSummary/orderSummary.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	
	
	}
	
}