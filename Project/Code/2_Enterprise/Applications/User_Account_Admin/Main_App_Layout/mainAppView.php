<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class mainAppView extends viewSuperClass_Core
{
	
	public function display_Main_Application_Layout()
	{
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/_Common/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('COMMON CS JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/User_Account_Admin/Main_App_Layout/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('ACCOUNT CS JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/User_Account_Admin/Main_App_Layout/templates/main_app_layout.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
	}
	
}
?>