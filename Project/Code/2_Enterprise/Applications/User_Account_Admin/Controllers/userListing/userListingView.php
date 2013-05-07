<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class userListingView extends applicationsSuperView
{
	public function display_Main_Application()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/User_Account_Admin/Controllers/templates/userApplicationContent.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
	
	public function display_Navigation()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/User_Account_Admin/Controllers/templates/usersApplicationSidebar.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_LEFT_COLUMN'=>$content));
	}
	
	public function display_Edit_Application()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/User_Account_Admin/Controllers/templates/userApplicationEdit.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
}