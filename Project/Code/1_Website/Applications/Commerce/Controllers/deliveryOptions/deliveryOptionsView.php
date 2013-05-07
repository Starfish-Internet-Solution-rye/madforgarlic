<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class deliveryOptionsView extends applicationsSuperView
{
	public function showDeliveryOptionsForm()
	{
		
				
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/deliveryOptions/deliveryOptions.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
		
		
	}
	
	
	
}