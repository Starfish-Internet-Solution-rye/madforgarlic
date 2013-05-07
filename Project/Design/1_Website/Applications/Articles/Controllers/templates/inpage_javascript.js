$(document).ready(function() {
	
//	$('.thumbnail_container').click(function(){
//		$(this).closest('div.fright').find('div.active').removeClass('active');
//		$(this).addClass('active');
//		
//		loadBackground();
//		
//	});
	
});	


function loadBackground(image_id){
	//retrieve image through AJAX
	$.php('/ajax/Articles/load_imageAjax',{image_id:image_id});
	$('#loader').fadeIn();
	
}