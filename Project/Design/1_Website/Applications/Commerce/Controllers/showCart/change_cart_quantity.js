$(document).ready(function()
{
	 $("select.changequantity").change(function () {
       var id = $(this).attr("product_id");
       var quantity =  $('#quantity_div_'+id+' option:selected').text();
         
       $.php('/ajax/eshop/changeItemQuantity?product_id='+id+'&quantity='+quantity,{});
         
      })


});