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
	public $array_of_link_texts = array();
	private $array_of_url_names = array();
	
	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};	else return NULL;
	}
	
	//=================================================================================================
	
	public function _set($field, $value)
	{
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	//=================================================================================================
	
	public function __construct()
	{		
		
			//JQUERY LIBRARY ==========================================================================================================
			  $content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JQuery/templates/jquery_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('JQUERY LIBRARY'=>$content));
			
			//JQUERY AJAX ======================================================================================================	
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/Ajax/templates/jquery_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('JQUERYAJAX'=>$content),'TOP');
			
			//NIVO SLIDER ========================================================================================================	
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JSlider/templates/nivoSlider_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('NIVO SCRIPT'=>$content));
			
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JSlider/templates/nivoSlider_css_link.phtml');
			response::getInstance()->addContentToStack('css_used_on_every_page',array('NIVO CSS'=>$content));
			
			//Validation ===========================================================================================================
			$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/Validation/templates/validation_link.phtml');
			response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('VALIDATION SCRIPT'=>$content),'BOTTOM');
								
			//-----------------------------------------------------------------------------------------------------------------	
	}

	public function getMainLayout() 
	{
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/main.phtml');
		response::getInstance()->addContentToTree(array('TOPLEVEL'=>$content));

		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_css_links.phtml");
		response::getInstance()->addContentToStack('css_used_on_every_page',array('MAIN LAYOUT CSS'=>$content));

		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_inpage_javascript.js");
		response::getInstance()->addContentToStack('inpage_javascript_bottom',array('MAIN INPAGE JAVASCRIPT'=>$content));
        
       	//GLOBAL SCRIPTS ========================================================================================================
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/global_js_links.phtml');
		response::getInstance()->addContentToTree(array('GLOBAL_SCRIPTS'=>$content));
		
		
        // GOOGLE ANALYTICS ===============================================================================================
        $this->displayGoogleAnalytics();
   }
        
//=================================================================================================
        
        public function displayGoogleAnalytics() {
        	return $this->google_analytics;
        }
        
//=================================================================================================
        
        public function setGoogleAnalytics($analytics) {
        	$this->google_analytics = $analytics;
        }
   

	//--------------------------------------------------------------------------------

	protected function displayHeader()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/header/headerController.php';
 		$headerView = new headerController();
 		$headerView->getHeader();
	}


	protected function displayFooter()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/footer/footerController.php';
		$footerController = new footerController();
		$footerController->getFooter();
				
	}
	
}
?>