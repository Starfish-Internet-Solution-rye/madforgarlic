<?
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/System/Products/category.php';

require_once 'categoryView.php';

class categoryController extends applicationsSuperController
{
	public function indexAction()
	{
		header('Location: /products');
	}
	
//-------------------------------------------------------------------------------------------------

	public function addAction()
	{
		$category = new category();
		$category->__set('category_title', $_REQUEST['title']);
		$category->__set('category_url', $this->replaceChars($_POST['category_url']));
		$category->insert();
			
		$this->logEvent("ADDED Category '{$_REQUEST['title']}'");
		
		header('Location: /products/subcategory/edit/'.$category->__get('category_id'));
	}
	
//-------------------------------------------------------------------------------------------------

	public function editAction()
	{
		$category_id = $this->getValueOfURLParameterPair('edit');
		
		if(!is_numeric($category_id))
			$this->indexAction();
		
		$category = new category();
		$category->__set('category_id', $category_id);
		$category->select();
		
		if(isset($_POST['edit_category']))
		{
			$category->__set('category_title', $_POST['title']);
			$category->__set('category_url', $this->replaceChars($_POST['category_url']));
			$category->update();
			
			$this->logEvent("UPDATED {$category_id}");
		}
		
		$view = new categoryView();
		$view->_set('category', $category);
		$view->displayCategoryEditor();
	}
	
//-------------------------------------------------------------------------------------------------

	public function deleteAction()
	{
		$category_id = $this->getValueOfURLParameterPair('delete');
		
		if(!is_numeric($category_id))
			$this->indexAction();
		
		$category = new category();
		$category->__set('category_id', $category_id);
		$category->delete();
		
		$this->logEvent("DELETED {$category_id}");
		
		header('Location: /products');
	}
	
//-------------------------------------------------------------------------------------------------

	public function logEvent($message)
	{
		$fh = fopen(STAR_SITE_ROOT."/Project/Code/2_Enterprise/Applications/Products/Controllers/category/log.txt", 'a') or die('no such file');
		$stringData = $_SERVER['REMOTE_ADDR'].": ".date("F j, Y, g:i a")." - {$message}\n";
		fwrite($fh, $stringData);
		fclose($fh);;
	}
	
//-------------------------------------------------------------------------------------------------	
	
	private function replaceChars($permalink)
	{
		$characters = array(' ','_',',','\'','.',':',';','?','!');
		
		$string = strtolower(str_replace($characters, '-', $permalink));
		
		return trim($string, '-');
	}
}


?>