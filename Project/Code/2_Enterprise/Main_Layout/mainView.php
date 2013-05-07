<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');
/**
 * The Main Layout gets all the content for the areas outside the main focus.
 * Eg. if you are on www.MyResort.com/accommodation or even www.MyResort.com, 
 * the focus will be on a page
 * but you have other tasks like header photo, logo, navigation
 * these will be needed on most pages. 
 * 
 */


class mainView extends viewSuperClass_Core
{
	public function __construct()
	{		
	
	
			//JQUERY LIBRARY =======================================================================================================
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JQuery/templates/jquery_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('JQUERY'=>$content),'TOP');
				
			//JQUERY AJAX =======================================================================================================		
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/Ajax/templates/jquery_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('JQUERYAJAX'=>$content),'TOP');
			
			//JQUNIFORM =======================================================================================================	
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JQuery_Uniform/templates/jquery_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('JQUERYUNIFORM'=>$content));
				
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JQuery_Uniform/templates/css_links.phtml');
			response::getInstance()->addContentToStack('css_used_on_every_page',array('JQUERYUNIFORM CSS'=>$content));
			
			//JTEXTAREA EXPANDER =======================================================================================================
			 $content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/TextareaExpander/templates/JtextareaExpander_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('TEXTAREA EXPANDER'=>$content));
			
			//NIC EDITOR =======================================================================================================
			//$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/nicEditor/templates/nicEditor_link.phtml');
			//response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('NIC EDIT SCRIPT'=>$content));
			
			//DATEPICKER =======================================================================================================
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JCalendar/templates/JCalendar_script_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('JQUERY CALENDAR'=>$content));

			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JCalendar/templates/Jcalendar_css_link.phtml');
			response::getInstance()->addContentToStack('css_used_on_every_page',array('JQUERY CALENDAR CSS'=>$content));
				
			//Validation Engine =======================================================================================================
            $content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/ValidationEngine/templates/validationEngine_link.phtml');
            response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('JQUERY VALIDATIONENGINE'=>$content),'BOTTOM');

            $content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/ValidationEngine/templates/validationEngine_css_link.phtml');
            response::getInstance()->addContentToStack('css_used_on_every_page',array('JQUERY VALIDATIONENGINE CSS'=>$content));
            
            
			//-----------------------------------------------------------------------------------------------------------------	
	}

	public function getMainLayout() 
	{
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/main.phtml');
		response::getInstance()->addContentToTree(array('TOPLEVEL'=>$content));
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_css_links.phtml");
		response::getInstance()->addContentToStack('css_used_on_every_page',array('MAIN LAYOUT CSS'=>$content));
			
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_inpage_javascript.js");
		response::getInstance()->addContentToStack('inpage_javascript_top',array('MAIN INPAGE JAVASCRIPT'=>$content));
	    
	}

	//--------------------------------------------------------------------------------

	public function displayHeader()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/header/headerController.php';
 		$headerView = new headerController();
 		$headerView->getHeader();
	}


	public function displayFooter()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/footer/footerController.php';
		$footerController = new footerController();
		$footerController->getFooter();
				
	}
	
	
	
	
	
	
}
?>