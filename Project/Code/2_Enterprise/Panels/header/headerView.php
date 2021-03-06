<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');
class headerView extends viewSuperClass_Core
{
	public function getHeader()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Panels/header/templates/css_links.phtml','HEADER_CSS');
		response::getInstance()->addContentToStack('css_used_on_every_page',array('HEADER_CSS'=>$content));
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Panels/header/templates/main_template.phtml");
		response::getInstance()->addContentToTree(array("HEADER_CONTENT"=>$content));
		
	}
}
?>