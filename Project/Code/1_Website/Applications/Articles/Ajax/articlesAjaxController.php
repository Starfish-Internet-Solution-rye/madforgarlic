<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
//----------------------------------------------------------

class articlesAjaxController extends applicationsSuperController
{

	
	 public function testFunctionAction()
	 {
	 	jQuery('#phpAjaxCall')->html("dspakdpsa");
	 	jQuery::getResponse();
	 }
	 
//-------------------------------------------------------------------------------------------------
	 
	 public function load_imageAjaxAction()
	 {
	 	require_once 'Project/Code/System/Photo_Library/image/image.php';
	 
	 	$image_path = '';
	 	$image_caption = '';
	 
	 	if(isset($_REQUEST['image_id']))
	 	{
	 		$image = new image();
	 		$image->setImageID($_REQUEST['image_id']);
	 		$image->selectFullPath();
	 		$image->select();
	 			
	 		$image_path = $image->getFullPath();
	 		$image_caption = $image->getImageCaption();
	 	}
	 
	 	//place the image location on the src attribute of #image_full
	 
	 	jQuery('#gallery_image')->css('background-image','url(/Data/Images/'.$image_path.')');
	 	jQuery::getResponse();
	 
	 }
}