<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
//----------------------------------------------------------

class articlesBlockController 
{

public function getOtherNews()
	{
		$articles = new articles();
		$articles->selectOtherNews();
		
		$view = new articlesBlockView();
		$view->_set('array_of_articles', $articles->getArrayOfArticles());
		$view->displayRandomArticles();
	}
	
	
}