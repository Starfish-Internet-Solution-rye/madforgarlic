<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/System/Routes/route.php';
require_once 'articlesView.php';
require_once 'articlesModel.php';


class articlesController extends applicationsSuperController
{

	private $url_parameters;
	public function __construct()
	{
		parent::__construct();
		$this->url_parameters = routes::getInstance()->_pathInfoArray;
	}
	
	public function indexAction()
	{
		array_shift($this->url_parameters);
		$articlesView = new articlesView();
		if(count($this->url_parameters) == 1){
			if(route::ifPermalinkExists($this->url_parameters[0]))
			{
				$this->article_details($this->url_parameters[0]);
			}
			else
				$this->getArticleListing();
	
		}
		elseif(count($this->url_parameters) >= 1)
		{
			$this->getArticleListing(TRUE);
		}
		else
		$this->getArticleListing();
	
		$articlesView->displayMain();
	}
	
	public function getArticleListing($archive = FALSE)
	{
		require_once 'Project/Code/System/Articles/articles.php';
		$articles = new articles();
		$articlesView = new articlesView();
	
		if($archive)
		{
			$month			= date('m',strtotime($this->url_parameters[1]));//convert month from string to integer
			$year			= $this->url_parameters[2];
				
			$articles->selectByArchive($month, $year);
			$articlesView->_set('current_archive_month', $this->url_parameters[1]);
			$articlesView->_set('current_archive_year', $year);
		}
		else
			$articles->select();
	
		$articlesView->_set('array_of_articles', $articles->__get('array_of_articles'));
		$articlesView->_set('array_of_archives', $articles->selectArchivesList());
		$articlesView->displayArticle();
	}
	
	public function article_details($permalink = NULL)
	{
		require_once 'Project/Code/System/Articles/article.php';
		$article = new article();
		$article->__set('permalink', $permalink);
		$article->select();
	
		$articlesView = new articlesView();
		$articlesView->_set('article', $article);
	
		$articlesView->_set('nextPermalink', $article->selectPrevOrNextPostPermalink('next'));
		$articlesView->_set('prevPermalink', $article->selectPrevOrNextPostPermalink('prev'));
		$articlesView->displayArticleDetail();
	}
	
}