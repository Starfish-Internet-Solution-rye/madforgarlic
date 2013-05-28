$(document).ready(function() {
	$("#contact_form").submit(function(e) {
		e.preventDefault();
		var contactId = $("#contact_form").attr('id');

		if (validateForm()) { 
			$.php('/ajax/contact-us/submitEmailAjax',$(this).serialize());
			
//			php.error = function(xmlEr, typeEr, except) {}
			php.complete = function(XMLHttpRequest, textStatus) {
				
			//place confirmation script here
			$('#contact_form').fadeOut();
			$('#sent-confirmation').fadeIn();
			$('#sent-confirmation').delay(200).fadeOut("slow",function(){
			$('#contact_form').fadeIn();
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
			contactNumber:{
				required:true,
				digits:true,
				},
			branch:{
				required:true,
				},
				date_visit:{
				required:true,
				date:true,
				},
		},
		
		messages: {
			
			name:{
				required:"Please fill up the required fields marked by *",
			},
			email:{
				required:"Please fill up the required fields marked by *",
				email:"Please enter a valid email address."
			},
			contactNumber:{
				required:"Please fill up the required fields marked by *",
				digits:"Please enter a valid Contact Number",
			},
			branch:{
				required:"Please fill up the required fields marked by *",
			},
			date:{
				required:"Please fill up the required fields marked by *",
				date:"Please enter a valid date",
			},
		}
		
	}).form();
}