<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');
class headerView extends viewSuperClass_Core
{
	public function getHeader()
	{
		
		$this->getShoppingCartBlock();
		
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Panels/header/templates/css_links.phtml','HEADER_CSS');
		response::getInstance()->addContentToStack('css_used_on_every_page',array('HEADER_CSS'=>$content));
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Panels/header/templates/main_template.phtml");
		response::getInstance()->addContentToTree(array("HEADER_CONTENT"=>$content));
	}
	
	
	
	protected function getFlagHyperLink($country)
	{
		// I could call hyperlink class directly from the template
		// but I think that the designer should only know to call functions int the class of the same name
		// and that all functionality is done in the view class
		 
		// having said that language is  core functionality and should be dealt with by the the core object language
		// and not by the PHP application developer
	
		return language::getInstance()->getLanguageHyperlink($country);
	
	}
	
	
	private function getShoppingCartBlock()
	{
		$content = $this->displayApplicationBlock('Commerce','shoppingCartControlPanel');
		response::getInstance()->addContentToTree(array("SHOPPING_BASKET_BLOCK"=>$content));
	}
	
	
}
?>