@extends('layouts.app')
@section('content')
<div class="container-fluid mimin-wrapper">
	<div id="content" style="padding-left: 0 !important">
		<div class="panel box-shadow-none content-header">
			<div class="panel-body">
				<div class="col-md-12">
					<h3 class="animated fadeInLeft">{{ $_nav_title }}</h3>
					<p class="animated fadeInDown">
						{{ $_nav_title }}
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading"><h3>Danh sách sản phẩm ({{ $articleItems->count() }})</h3></div>
					<div class="panel-body">
						<div class="col-md-9">
							<div class="row">
								<form action="?" method="GET">
									<div class="col-md-5">
										<select name="cmdCategory" class="form-control">
											<option value="0">Category</option>
											@foreach($categories as $category)
											<option {{ Request::get('cmdCategory') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
												{{ $category->name }}
											</option>
											@foreach(App\Models\ProductType::where('parent', $category->id)->get() as $subCategory)
											<option {{ Request::get('cmdCategory') == $subCategory->id ? 'selected' : '' }} value="{{ $subCategory->id }}">
												> {{ $subCategory->name }}
											</option>
											@endforeach
											@endforeach
										</select>
									</div>
									<div class="col-md-5">
										<input type="text" name="txtName" class="form-control" style="border-radius: 5px !important;" value="{{ null !== 'expression' ? Request::get('txtName') : '' }}">
									</div>
									<div class="col-md-2">
										<input type="submit" class="form-control btn-info" value="Search">
									</div>
								</form>
							</div>
							<hr>
							<div class="row">
								@foreach($articleItems as $articleItem)
								<div class="col-md-2 col-sm-3 col-xs-6">
									<div style="height: 250px;display: block;overflow: hidden;">
										@if(count(App\Models\Gallery::find($articleItem->image_thumb)) != 0)
										<img style="width: 100%" src="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}" data-zoom-image="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}"/>
										@endif
										<span style="height: 40px;display: block;overflow: hidden;">
											{{ $articleItem->name }}
										</span>
										<br>
										<button style="width: 100%" class="addtocart btn btn-default" data-id="{{ $articleItem->id }}" data-token="{{ csrf_token() }}">Chọn</button>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-md-3">
							<b>Giỏ hàng</b>
							<hr>
							<div class="cart_items">
								@if (Cart::count() > 0)
								@foreach(Cart::content() as $c_item)
								<p>- {{ $c_item->name }} x {{ $c_item->qty }}</p>
								@endforeach
								<b>Tổng tiền: {{ Cart::subtotal() }}đ</b>
								@else
								<b>Giỏ hàng trống</b>
								@endif
							</div>
							<hr>
							<b>Thông tin khách hàng</b>
							<hr>
							<form action="{{ Request::url() }}" enctype="multipart/form-data" method="POST">
								{{ csrf_field() }}
								<label for="">Phone</label><br>
								<input class="form-control cus_phone" type="text" name="cus_phone" id="" onkeypress="validate(event)" data-token="{{ csrf_token() }}" required>
								<label for="">Name</label><br>
								<input class="form-control cus_name" type="text" name="cus_name" id="" required>
								<label for="">Address</label><br>
								<input class="form-control cus_address" type="text" name="cus_address" id="" required>
								<label for="">Shipping Fee</label><br>
								<input class="form-control" type="text" name="cus_feeship" id="" value="0" required><br>
								<label for="">Note</label><br>
								<textarea class="form-control" type="text" name="order_note" id=""></textarea><br>
								<input type="submit" class="form-control btn btn-danger makeOrder" data-carttotal={{ Cart::count() }} value="Order and Print">
							</form>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
</div>
<script>
	function validate(evt) {
		var theEvent = evt || window.event;
		if (theEvent.type === 'paste') {
			key = event.clipboardData.getData('text/plain');
		} else {

			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
		}
		var regex = /[0-9]|\./;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
	$(document).ready(function() {
		$('.addtocart').on('click', function () {
			var product_id = $(this).data('id');
			var token = $(this).data('token'); 

			$.ajax({
				url: _base_url + "cart/addtocart",
				type: 'post',
				data: {
					id: product_id,
					_token: token
				},
				success:(function(result) {
					if (result.error == false) {
						var cart = result.cart;
						var html = '';
						for(var k in cart) {
							html += '<p>- ' + cart[k].name + ' x ' + cart[k].qty + '</p>';
						}
						html += '<b>Tổng tiền: ' + result.total + 'đ</b>';
						$('.cart_items').html(html);
						$('.makeOrder').attr("data-carttotal", result.totalQty);
					} else {
						$.notify({
							message: "Thêm giỏ sản vào giỏ hàng không thành công!"
						},{
							type: 'danger'
						});
					}
				})
			})
			return false;
		});
		$('.makeOrder').click(function (){
			var totalCart = $(this).data('carttotal');
			var cus_phone = $('.cus_phone').val();
			var cus_name = $('.cus_name').val();
			var cus_address = $('.cus_address').val();

			if (totalCart < 1) {
				alert('Giỏ hàng có éo đâu mà đặt hàng');
				return false;
			}
			if (cus_phone == '') {
				alert('Nhập số điện thoại đi ku');
				return false;
			} else if (cus_name == '') {
				alert('Nhập tên khách hàng đi ku');
				return false;
			} else if (cus_address == '') {
				alert('Éo có địa chỉ sao giao hàng?');
				return false;
			} else {
				return true;
			}
		})
		$('.cus_phone').blur(function() {
			var phone = $(this).val();
			var token = $(this).data('token');
			$.ajax({
				url: _base_url + "/cart/checkout/shipping/search-info",
				type: 'post',
				data: {
					phone: phone,
					_token: token
				}
			})
			.done(function(result) {
				if (result.error == "false") {
					$('.cus_name').val(result.info.cus_name);
					$('.cus_address').val(result.info.cus_address);
				}
			})			
			return false;
		})
	});
</script>
@endsection