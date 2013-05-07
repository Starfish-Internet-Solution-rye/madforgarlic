$(document).ready(function(){
	
	$(".changeTitle").click(function(){
		$(".box").removeClass("hide").addClass("show");
		$(".changeTitle").addClass("hide");
	});
	$(".cancel").click(function(){
		$(".box").removeClass("show").addClass("hide");
		$(".changeTitle").removeClass("hide");
		
	});
	$('.image_holder').bind('click',function(){
	    $('.image_holder > div.active').removeClass('active');
	    $(this).find('> div').addClass('active');
	});
	
	$('input[type="submit"][name*="save"],input[type="submit"][name*="delete"]').live('click',function(){
		showLoader();
	});	
	
	//JQUNIFORM
	$("select, input:checkbox, input:text, input:password, textarea, input:radio").uniform();
//-------------------------------------------------------------------------------------------------
	
});

function showLoader()
{
	$('#global_loader, #popUp_background').fadeIn(function(){
		$('#popUp_background').click(function(e){
			e.preventDefault();
		})
	});
}