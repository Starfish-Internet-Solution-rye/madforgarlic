<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
//----------------------------------------------------------

class articlesAjaxController extends applicationsSuperController
{

	
	 public function testFunctionAction()
	 {
	 	jQuery('#phpAjaxCall')->html("dspakdpsa");
	 	jQuery::getResponse();
	 }
}