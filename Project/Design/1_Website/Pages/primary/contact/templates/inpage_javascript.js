$(document).ready(function() {
	$("#contact_form").submit(function(e) {
		e.preventDefault();
		var contactId = $("#contact_form").attr('id');

		if (validateForm()) { 
			$.php('/ajax/contact-us/submitEmailAjax',$(this).serialize());
			
//			php.error = function(xmlEr, typeEr, except) {}
			php.complete = function(XMLHttpRequest, textStatus) {
				
			//place confirmation script here
			$('#sent-confirmation').fadeIn();
			$('#sent-confirmation').delay(2000).fadeOut("slow");
			
			$('#wrapper').click(function() {
				$('#sent-confirmation').fadeOut("slow");
			});
			
			resetForm(contactId);
		
			}
		}
	});	
});
function resetForm(id) {
	$('#'+id).each(function(){
		this.reset();
	});
}	
function validateForm() {
	
	return $("#contact_form").validate({
		
		rules:{
			name:{
				required:true,
				},
			email:{
				required:true,
				email:true
				},
			fName: "required",
			message: "required"
		},
		
		messages: {
			
			name:{
				required:"Please fill up the required fields marked by *",
			},
			email:{
				required:"Please fill up the required fields marked by *",
				email:"Please enter a valid email address."
			},
			fName: "Fill out Name field",
			message: "Fill out Name Message"
		}
		
	}).form();
}