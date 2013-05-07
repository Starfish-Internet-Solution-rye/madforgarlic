<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class articlesBlockView extends applicationsSuperView
{
	private $array_of_articles;
	
//=================================================================================================
	
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
	
	public function displayRandomArticles()
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Applications/Articles/Blocks/other_news.phtml');
		response::getInstance()->addContentToTree(array('OTHER_NEWS'=>$content));
	}
}