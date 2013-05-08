$(document).ready(function(){

	//image id check
    $('.imageId_error span.sprite').click(function(){
    	$('.popupDialog,#popUp_background').fadeOut();
    });
	
    CKEDITOR.replaceAll('editor');
    
    $('input[type="file"][id="file"]').change(function(){
    	var trueValue = $(this).attr('value');
    	trueValue = trueValue.replace('C:\\fakepath\\','');
    		
    	random_number = Math.floor((Math.random()*100)+1);
    	hashed_filename = Math.round((new Date()).getTime() / 1000) + "_" + random_number;
    	
    	//take note.. (:) is " and | is &
    	//i did this to prevent error in reading xml
    	path = 'menu/downloadmenu?filename=:'+trueValue+':|path=:'+hashed_filename+':';
    	
    	$('#pdf_name').text(trueValue);
    	$(this).closest('.pdf_link').find('input[type="hidden"]').val(trueValue);
    	$('#path').val(path);
    	$("input[name='hashed_filename']").val(hashed_filename);
    	
    });
});