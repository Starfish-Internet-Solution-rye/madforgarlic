$(document).ready(function(){
	$('select[name=category_id]').change(function(){
		$.php('/ajax/transactions/load_subcategory',{category_id:$(this).val()});
	});
	$('input[name="date_from"],input[name="date_to"]').datepicker({ dateFormat: "mm-dd" });
});