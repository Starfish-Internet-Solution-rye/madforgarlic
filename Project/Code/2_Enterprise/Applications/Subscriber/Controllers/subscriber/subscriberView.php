<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class subscriberView extends applicationsSuperView
{
	
	private $array_of_subscriber;
	
	
	public function setSubscriber($array_of_subscriber)
	{
		$this->array_of_subscriber  = $array_of_subscriber;
	}
	
	public function getSubscriber()
	{
		if($this->array_of_subscriber != null)
			return $this->array_of_subscriber;
		else
			return false;
	}
	
	//--------------------------------------------------------------------------------------------
	
	public function displaySubscriberTemplate()
	{
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/Subscriber/Controllers/templates/subscriber/subscriber.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
		
	}
	
	
}