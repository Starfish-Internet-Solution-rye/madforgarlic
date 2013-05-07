<?php
require_once 'Project/Code/ApplicationsFramework/FrontController/applicationsFrontController.php';
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';

require_once 'Project/Code/1_Website/Applications/User_Account/Modules/Mail/email.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core
{
	public function submitEmailAjaxAction()
	{
		$from_email = $_REQUEST['mail'];
		$from_name 	= $_REQUEST['name'];
		$subject 	= 'New Inquiry';
		$body 		= "
			Name: {$_REQUEST['name']}<br>
			Email: {$_REQUEST['mail']}<br>
			Contact Number: {$_REQUEST['number']}<br><br>
			Inquiry Details: <p>{$_REQUEST['message']}</p><br><br>
			AGL Energy Limited,<br>
			Locked Bag 1837,<br>
			St Leonards,<br>
			NSW 2060
			
		";

		email::send_email(NULL, NULL, $from_email, $from_name, $subject, $body);

		jQuery::getResponse();
	}
}
?>