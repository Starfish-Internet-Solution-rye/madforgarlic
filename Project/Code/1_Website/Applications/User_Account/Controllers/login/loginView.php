<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class loginView extends applicationsSuperView
{
	public function showLoginForm()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/User_Account/Modules/account_panel/templates/login_form.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
}