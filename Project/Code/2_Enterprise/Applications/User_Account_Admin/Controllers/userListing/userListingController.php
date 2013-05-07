<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'userListingModel.php';
require_once 'userListingView.php';

class userListingController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new userListingView();
		$view->display_Main_Application();
		$view->display_Navigation();
		
	}
	
	public function editAction()
	{
		//if(isset())
		
		
		$view = new userListingView();
		$view->display_Edit_Application();
		$view->display_Navigation();
	}
	
}