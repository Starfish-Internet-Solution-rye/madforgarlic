$(document).ready(function() {
	/*if($('#hasLeftColumn').val() == 'yes')
		$('#outer_wrapper').removeClass('noLeftColumn');*/
	
//-------------------------------------------------------------------------------------------------		
//FORM VALIDATION

	jQuery("form").validationEngine();    

//-------------------------------------------------------------------------------------------------  

	$('span.addCategory').click(function(){
		$('div.addCategory_popUp, #popUp_background').fadeIn();
	});

	$('span.addSubCategory').click(function(){
		$('div.addSubCategory_popUp, #popUp_background').fadeIn();
		
		category_id = $(this).children('input[name=category_id]').val();
		
		$('div.addSubCategory_popUp input[name=category_id]').val(category_id);
	});

	$('span.addArticle').click(function(){
		$('div.addArticle_popUp, #popUp_background').fadeIn();
		
		category_id		= $(this).children('input[name=category_id]').val();
		subcategory_id	= $(this).children('input[name=subcategory_id]').val();
		
		$('div.addArticle_popUp input[name=category_id]').val(category_id);
		$('div.addArticle_popUp input[name=subcategory_id]').val(subcategory_id);
	});

	$('span.deleteCategory').click(function(){
		$('div.deleteCategory_popUp, #popUp_background').fadeIn();
	});

	$('span.deleteSubCategory').click(function(){
		$('div.deleteSubCategory_popUp, #popUp_background').fadeIn();
	});

	$('span.deleteArticle').click(function(){
		$('div.deleteArticle_popUp, #popUp_background').fadeIn();
	});

	$('span.keep_article, span.cancel').click(function(){
		$('div.popupDialog, div.popUp_delete, #popUp_background').fadeOut();
	});
	
});

$("#intro").htmlbox({});
$("#brief").htmlbox({});
$("#our_approach").htmlbox({});
$("#what_we_did").htmlbox({});