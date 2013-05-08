$(document).ready(function(){
	Cufon.replace('#homeBanner h3,#sent-confirmation h2', { fontFamily: 'Helvetica Neue LT Std' });
	Cufon.replace('#primary_nav li a,#menu_subNav li a,#downloadMenu,#forReserve .fs-xs,p,#sent-confirmation,#newsletter label', { fontFamily: 'HelveticaNeueLT Com 45 Lt' });
	Cufon.replace('#homeBanner p, #forReserve .fs-s', { fontFamily: 'Helvetica Neue LT Std 55' });
	Cufon.replace('.menuList h1,.menuList h3,.menuList p', { fontFamily: 'Goudy Old Style' });
	
	
	
	//ajax for adding subscriber
	$("input[name='subscriber']").click(function(e){
		e.preventDefault();
		if (validateForm()) { 
		email = $("input[name='email']").val();
		$.php('/ajax/home/addSubscriber', {email:email});	
		
		php.complete = function(){
			$("input[name='email']").val('');
			$('#subcription_form').fadeOut();
			$('#subcriptionSent').fadeIn();
			$('#subcriptionSent').delay(2000).fadeOut("slow");
			
			$('#wrapper').click(function() {
				$('#subcriptionSent').fadeOut("slow");
				$('#subcription_form').fadeIn();
			});
		}
		
		}
	});
	function validateForm() {
		
		return $("#subcription_form").validate({
			
			rules:{
				email:{
					required:true,
					email:true
					},
				fName: "required",
				message: "required"
			},
			
			messages: {
				
				email:{
					required:"This is a required field",
					email:"Please enter a valid email address."
				},
				fName: "Fill out Name field",
				message: "Fill out Name Message"
			}
			
		}).form();
	}
});

