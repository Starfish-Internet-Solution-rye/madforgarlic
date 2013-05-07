$(document).ready(function(){

	//image id check
    $('.imageId_error span.sprite').click(function(){
    	$('.popupDialog,#popUp_background').fadeOut();
    });
	
    CKEDITOR.replaceAll('editor');
});