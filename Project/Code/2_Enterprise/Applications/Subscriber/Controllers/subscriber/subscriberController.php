<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'subscriberView.php';
require_once 'subscriberModel.php';
require_once 'Project/Code/System/Subscriber/subscribers.php';
require_once 'Project/Code/System/Subscriber/subscriber.php';

class subscriberController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new subscriberView();
		
		$subscribers = new subscribers();
		$subscribers->select();
		
		$view->setSubscriber($subscribers->getArrayOfSubscriber());
		$view->displaySubscriberTemplate();
	}
	
//------------------------------------------------------------------------------------------------------------------------

	public function filterAction()
	{
		$view = new subscriberView();
		
		$subscribers = new subscribers();
		$subscribers->selectByFilter($_POST['email']);
		
		$view->setSubscriber($subscribers->getArrayOfSubscriber());
		$view->displaySubscriberTemplate();
	}
		
//------------------------------------------------------------------------------------------------------------------------
	
	public function deleteAction()
	{
		$subscriber = new subscriber();
		
		$subscriber_id = implode($_POST['subscriber_id'], ',');
	
		$subscriber->deleteWhereIn($subscriber_id);
		
		header('Location: /subscriber');
	}
	
	
	
}


