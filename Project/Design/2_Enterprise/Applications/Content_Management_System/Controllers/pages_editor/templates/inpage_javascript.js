$(document).ready(function(){

	//image id check
    $('.imageId_error span.sprite').click(function(){
    	$('.popupDialog,#popUp_background').fadeOut();
    });
	
    CKEDITOR.replaceAll('editor');
    
    $('input[type="file"][id="file"]').change(function(){
    	var trueValue = $(this).attr('value');
    	trueValue = trueValue.replace('C:\\fakepath\\','');
    	
    	$('#pdf_name').text(trueValue);
    	//$(this).closest('.pdf_link').find('input[type="hidden"]').val(trueValue);
    });
});