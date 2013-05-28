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
		$from_email = $_REQUEST['email'];
		$from_name 	= $_REQUEST['name'];
		$subject 	= 'New Inquiry';
		$body 		= "
			Name: {$_REQUEST['name']}<br />
			Email: {$_REQUEST['email']}<br />
			Contact No.: {$_REQUEST['contactNumber']}<br />
			Branch: {$_REQUEST['branch']}<br />
			Date of Visit: {$_REQUEST['date_visit']}<br />
			Comment: <p>{$_REQUEST['comment']}</p><br /><br />
			Mad for Garlic,<br />
			W Global Center,<br />
			30th Street corner 9th Ave.,<br>
			Bonifacio Global City,<br />
			Taguig
			
		";

		email::send_email(NULL, NULL, $from_email, $from_name, $subject, $body);

		jQuery::getResponse();
	}
}
?>