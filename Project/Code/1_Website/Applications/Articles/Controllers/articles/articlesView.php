<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class articlesView extends applicationsSuperView
{
	private $array_of_articles 	= array();
	private $array_of_archives 	= array();
	private $article;
	private $current_archive_month;
	private $current_archive_year;
	private $prevPermalink;
	private $nextPermalink;
	
//=================================================================================================

	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};	else return NULL;
	}
	
//=================================================================================================
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
//=================================================================================================	

	public function displayMain()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Articles/Controllers/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('ARTICLES CSS JS LINK'=>$content));
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Articles/Controllers/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
	public function displayArticle()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Articles/Controllers/templates/article_listing.phtml');
		response::getInstance()->addContentToTree(array('ARTICLE_CONTENT'=>$content));
	}
	
	public function displayArticleDetail()
	{
		//$this->displayApplicationBlock('Articles', 'getOtherNews');
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Articles/Controllers/templates/article_details.phtml');
		response::getInstance()->addContentToTree(array('ARTICLE_CONTENT'=>$content));
	}
	
	public function displayArchives()
	{
		foreach ($this->array_of_archives as $archive):
			if($this->current_archive_month == strtolower($archive['month']) && $this->current_archive_year == $archive['year'])
			{
				$active = 'class="active"';
			}
			else
				$active = '';
				echo '<li '.$active.'><a href="/news/archive/'.strtolower($archive['month']).'/'.$archive['year'].'"><span class="gray_arrow"></span>'.$archive['month'].' '.$archive['year'].'</a></li>';
		endforeach;
	}
	public function displayPrevNextButton()
	{
		$content = '<span class="fright">';
		if ($this->_get('prevPermalink') != ''):
			$content .= '<a class="fwB mRxl fleft" href="/news/'.$this->prevPermalink.'">&lt; previous post</a>';
		endif;
		if ($this->_get('nextPermalink') != ''):
			$content .= '<a class="fwB fright" href="/news/'.$this->nextPermalink.'">next post &gt;</a>';
		endif;
		$content .= '</span>';
		
		return $content;
	}
	
}