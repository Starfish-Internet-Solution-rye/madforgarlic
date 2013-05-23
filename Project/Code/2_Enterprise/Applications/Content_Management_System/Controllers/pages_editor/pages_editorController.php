<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'pages_editorModel.php';
require_once 'pages_editorView.php';
require_once 'Project/Code/2_Enterprise/Applications/Content_Management_System/Modules/fileUpload.php';
//----------------------------------------------------------
class pages_editorController extends applicationsSuperController
{
	
	public function indexAction()
	{
		$pages_editorModel = new pages_editorModel();
		
		$dataHandler = new dataHandler();
		$pagesXML = $dataHandler->loadDataSimpleXML('Project/Code/'.PRIMARY_DOMAIN.'/Pages/pages_navigation.xml');
		$pageXML = $pages_editorModel->getPageXML($pagesXML);
		
		
		if (isset($_POST['save'])) 
		{
			if(isset($_FILES['pdf']) && $_FILES['pdf']['tmp_name'] != "")
			{
				$path 			= STAR_SITE_ROOT."/Data/pdf";
				$accepted_types = array("application/pdf");
				$filename  		= $_FILES['pdf']['name']; 
				$ext 			= rtrim(substr($filename, strripos($filename, '.'))); 
				$pathName		= $_POST['hashed_filename'].$ext;
	
				$success = fileUpload::upload($_FILES, $path, $pathName, 'pdf', $accepted_types);
				
				if($success)
				{
					//delete the old pdf
					$old_filename_array = glob("Data/pdf/*");
					if(is_array($old_filename_array))
					{
						$basename = basename($old_filename_array[0]);
						if($basename != $pathName)
							unlink("Data/pdf/$basename");
						else
						{
							$basename = basename($old_filename_array[1]);
							unlink("Data/pdf/$basename");
						}
					}
				}
			}
			
			$domObj = $pages_editorModel->updateDOMObjectWithPOST($pageXML,1);
			$xmlObj = simplexml_import_dom($domObj);
			
			$fileNameOfPageXML = $pages_editorModel->getFileNameOfPageXML();
			
			
			$dataHandler->saveDataXML($fileNameOfPageXML,$xmlObj);
		}
		
		$pages_editor_View = new pages_editor_View();
		$pages_editor_View->displayPageEditor($pageXML);
		
	}
	
	//================================================================================================================================================
}