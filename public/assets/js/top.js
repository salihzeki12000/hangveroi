$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="_token"]').attr('content')
		}
	});
	$('.cmbCity').change(function() {
		var city_id = $(this).val();
		var AJAX_POST_URL = _base_url + "district_byID";
		$.ajax({
			url: AJAX_POST_URL,
			type: "post",
			data: {
				id: city_id
			},
			success: function(html)
			{	
				console.log(html);
				$('.cmbDistrict').html(html);
				$('.cmbDistrict').selectpicker('refresh');
			}
		});		
		return false;	
	});

	$('.quantity').change(function(){
		var quantity = $(this).val();
		var id_product = $(this).data("id");
		var rowid = $(this).data("rowid");
		var segment1 = $(this).data("segment1");
		var AJAX_POST_URL = _base_url + segment1 + "/" + "update-quantity-product";
		$.ajax({
			url: AJAX_POST_URL,
			type: "post",
			data: {
				rowid: rowid,
				id: id_product,
				qty: quantity,
			},
			success: function(html)
			{	
				console.log(html);
				location.reload();
			}
		});		
		return false;	
	});
});