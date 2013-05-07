<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class searchView extends applicationsSuperView
{
	private $templates_location;
	private $array_of_results;
	
	public function __construct()
	{
		$this->templates_location = 'Project/Design/2_Enterprise/Applications/Transactions/Controllers/templates/search/';
	}
	 
//=================================================================================================

	public function getArrayOfResults() { return $this->array_of_results; }
	 
//=================================================================================================

	public function setArrayOfResults($array_of_results) { $this->array_of_results = $array_of_results; }
	 
//=================================================================================================

	public function displaySearchContentColumn()
	{
		$this->displaySearchHeader();
		
		$content = $this->renderTemplate($this->templates_location.'search_content_column.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
	 
//=================================================================================================

	private function displaySearchHeader()
	{
		$content = $this->renderTemplate($this->templates_location.'search_header.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_HEADER'=>$content));
	}	
	 
}


