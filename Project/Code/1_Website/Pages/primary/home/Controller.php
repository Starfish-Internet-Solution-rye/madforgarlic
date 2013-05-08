<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once 'Project/Code/System/Subscriber/subscriber.php';

class controller extends controllerSuperClass_Core 
{
	public function addSubscriberAction()
	{
		$subscriber = new subscriber();
		
		$email = $_REQUEST['email'];
		
		$subscriber->selectByColumn('email', "'$email'");
		
		if(!$subscriber->getSubscriberID())
		{
			$subscriber->setEmail($email);
			$subscriber->insert();
		}
		
		jQuery::getResponse();
	}
}
?>