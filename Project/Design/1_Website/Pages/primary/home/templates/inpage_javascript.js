//$(document).ready(function() {
//	$('#slider').nivoSlider({
//		effect:'fade';,
//		animSpeed: 500,
//		pauseTime:3000,
//		controlNavThumbs: true,
//	});
//});

$(document).ready(function() {
	$('#slider').nivoSlider({
	effect:'fade',
	animSpeed:500,
	pauseTime:7000,
	directionNav: false,
	controlNav: true,
	});
	
	
	$("input[name='subscriber']").click(function(e){
		e.preventDefault();
		email = $("input[name='email']").val();
		$.php('/ajax/home/addSubscriber', {email:email});	
		
	});
});
