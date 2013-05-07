<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/2_Enterprise/Applications/Articles/Controllers/articles/articlesController.php';

class articlesAjaxController extends applicationsSuperController
{
	private $article_type;
	
	public function __construct()
	{
		parent::__construct();
		$this->article_type = routes::getInstance()->getCurrentTopLevelPageID();
	}
	
//-------------------------------------------------------------------------------------------------	

	public function execute_commandAction()
	{		
		/* if(isset($_REQUEST['article_id']))
		{
			$articleController = new articlesController();
			$articleController->deleteArticle($_REQUEST['article_id'], TRUE);
		} */
		
		jQuery::getResponse();
	}
	
//-------------------------------------------------------------------------------------------------	

	public function delete_articleAction()
	{		
		if(isset($_REQUEST['article_id']))
		{
			$articleController = new articlesController();
			$articleController->deleteArticle($_REQUEST['article_id'], TRUE);
		}
		
		jQuery::getResponse();
	}
	
//-------------------------------------------------------------------------------------------------	

	public function check_titleAction()
	{		
		require_once 'Project/Code/System/Articles/article.php';
		
		if(article::checkIfExists($this->article_type, $_REQUEST['title']))
			jQuery::addMessage('exists');
		else
			jQuery::addMessage('notexists');
		
		jQuery::getResponse();
	}
	
}