<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class productView extends applicationsSuperView
{
	private $templates_location;

	private $product;
	private $product_images;
	private $tags;
	
	//default for photo library
	private $album_id;
	private $size_id;
	
	public function __construct()
	{
		$this->templates_location = 'Project/Design/2_Enterprise/Applications/Products/Controllers/templates/products/';
	}
	
//-------------------------------------------------------------------------------------------------	

	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function _set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public function displayProductEditor()
	{
		$content = $content = $this->renderTemplate($this->templates_location.'product_editor.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
		
		$content = $this->renderTemplate($this->templates_location.'product_sidebar.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_SIDEBAR'=>$content));
		
		$content = $this->renderTemplate($this->templates_location.'delete_product_dialog.phtml');
		response::getInstance()->addContentToTree(array('DELETE_PRODUCT_DIALOG'=>$content));
	}
	
//-------------------------------------------------------------------------------------------------

	public function displayAddProductDialog()
	{	
		$content = $this->renderTemplate($this->templates_location.'add_product_dialog.phtml');
		response::getInstance()->addContentToTree(array('ADD_PRODUCT_DIALOG'=>$content));
	}
}
?>