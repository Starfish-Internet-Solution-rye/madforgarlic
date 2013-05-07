<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class mainAppView extends viewSuperClass_Core
{
	public function display_Main_Application_Layout()
	{
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/_Common/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('COMMON CS JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/Admin_Dashboard/Main_App_Layout/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('ARTICLE CS JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Admin_Dashboard/Main_App_Layout/templates/main_app_layout.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
		$this->display_top_Section();
		$this->display_bottom_Section();
	}
	
	private function display_top_Section()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Admin_Dashboard/Controllers/templates/left_column.phtml');
		response::getInstance()->addContentToTree(array('TOP'=>$content));
	}
	
	private function display_bottom_Section()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Admin_Dashboard/Controllers/templates/right_column.phtml');
		response::getInstance()->addContentToTree(array('BOTTOM'=>$content));
	}
	
}
?>