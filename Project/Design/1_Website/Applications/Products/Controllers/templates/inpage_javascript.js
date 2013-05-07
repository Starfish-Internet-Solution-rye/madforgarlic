$(document).ready(function() {
	
	
	
	$('#ajaxtest').click(function(){
		
		
		$.php('/ajax/our_articles/testfunction');
		
			php.complete = function ()  {
				$("#testcomplete").hide("slow");
		}	

		
	});
	
});	
