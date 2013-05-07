<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'loginView.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';
/*** load the userAccount class **/
require_once 'Project/Code/System/Accounts/userAccounts/userAccount.php';


class loginController extends applicationsSuperController
{
	
	public function indexAction()
	{
		$basePath  = request::getInstance()->getPathInfo(); //Zend function
		$loginView = new loginView();
		$loginView->showLoginForm();
		
		if (isset($_POST['login']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$user_account_id='2';
			$user_role='poo';
			
			$user_account = new userAccount();
			
			$user_account->setUserName($username);
			$user_account->setPassword($password);
			
			$user_account->setUserAccountID($user_account_id);
			$user_account->setUserRoleID($user_role);
			
			authorization::saveUserSession($user_account);
			
			header('Location: '.$basePath);
		}
		
		
	}
	
	
	
	
	//AJAX CONFIRMATION etc
	
}