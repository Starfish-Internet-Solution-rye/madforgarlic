$(document).ready(function(){
	Cufon.replace('#homeBanner h3', { fontFamily: 'Helvetica Neue LT Std' });
	Cufon.replace('#primary_nav li a,#menu_subNav li a,#downloadMenu,#forReserve .fs-xs,p', { fontFamily: 'HelveticaNeueLT Com 45 Lt' });
	Cufon.replace('#homeBanner p, #forReserve .fs-s', { fontFamily: 'Helvetica Neue LT Std 55' });
	Cufon.replace('.menuList h1,.menuList h3,.menuList p', { fontFamily: 'Goudy Old Style' });
	
	
	
	//ajax for adding subscriber
	$("input[name='subscriber']").click(function(e){
		e.preventDefault();
		email = $("input[name='email']").val();
		$.php('/ajax/home/addSubscriber', {email:email});	
		
		php.complete = function(){
			$("input[name='email']").val('');
		}
	});
});

