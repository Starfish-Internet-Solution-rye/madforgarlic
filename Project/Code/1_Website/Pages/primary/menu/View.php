<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	public function displayPageNavigation()
	{
		$content= $this->renderTemplate('/Project/Design/1_Website/Pages/primary/menu/templates/navigation.phtml');
		response::getInstance()->addContentToTree(array('SECONDLEVELNAVIGATION'=>$content));
	}
	
	public function getjScrollPane()
	{
		$this->getjEasing();
		$this->getjMouseWheel();
		
		$content= $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JCustomScrollBar/templates/JCustomScrollBar_script_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JSCROLL SCRIPT'=>$content));
		
		$content= $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JCustomScrollBar/templates/JCustomScrollBar_css_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JSCROLL CSS'=>$content));
	}
	
	public function getjEasing()
	{
		$content= $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JEasing/templates/jeasing_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JEASING SCRIPT'=>$content));
	}
	
	public function getjMouseWheel()
	{
		$content= $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JMouseWheel/templates/JMouseWheel_script_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JMOUSEWHEEL SCRIPT'=>$content));
	}
}
?>