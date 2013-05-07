$(document).ready(function()
{
	$('.removeFromCart').click(function() 
  	{
    	var id = $(this).attr("product_id")
    	//goes to products controller
	    $.php('/ajax/eshop/removeProductFromShoppingCart?product_id='+id,{});
	    
	    //removethe prefix uniqueId_
	    $('div#quantity_div_'+id).hide("slow");
	  });
});