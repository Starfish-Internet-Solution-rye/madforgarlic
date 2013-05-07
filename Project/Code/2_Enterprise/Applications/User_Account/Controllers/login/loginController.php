<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'loginView.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
require_once 'Project/Code/System/Settings/settings.php';
require_once 'Project/Code/System/Accounts/userAccounts/userAccount.php';

class loginController extends applicationsSuperController
{
	public function indexAction()
	{
		$basePath  = request::getInstance()->getPathInfo(); //Zend function
		
		if (isset($_POST['login']))
		{
			$username = $_POST['username'];
			$password = sha1(md5($_POST['password']));
		
			if(settings::selectLogin($username, $password) == TRUE)
			{
				$user_account = new userAccount();
				$user_account->setUsername($username);
				$user_account->setUserAccountID(1);
				$user_account->setUserRoleID('admin');
				 
				authorization::saveUserSession($user_account);
				header('Location: /');
			}
		
			else
			{
				$loginView = new loginView();
				$loginView->showLoginForm(TRUE);
			}
		}
		
		else
		{
			$loginView = new loginView();
			$loginView->showLoginForm();
		}
	}
}