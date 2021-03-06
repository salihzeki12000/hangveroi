@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li><a href="{{ URL::to('/account') }}">Tài khoản</a></li>
						<li class="active">Thông tin giao hàng</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-xs-12">
				<div class="progress border-radius-0">
					<div class="progress-bar progress-bar-striped progress-bar-danger active" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width:33.3%">
						Giỏ hàng
					</div>
					<div class="progress-bar progress-bar-striped progress-bar-danger active" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width:33.3%">
						Cập nhật giao hàng
					</div>
					<div class="progress-bar" role="progressbar" style="width:33.3%; background: #f5f6f7; color: #666">
						Tiến hành đặt hàng
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="panel panel-info border-radius-0">
					<div class="panel-heading"><b>GIAO HÀNG MIỄN PHÍ</b></div>
					<div class="panel-body font-size-15">
						<ol>
							<li><a href="https://ohangveroi.com">Ohangveroi.com</a> giao hàng miễn phí toàn quốc cho đơn hàng từ <b class="font-size-18">200.000đ</b>.</li>
							<li>Miễn phí giao hàng nội thành TP HCM cho đơn hàng chỉ từ <b class="font-size-18">100.000đ</b>.</li>
						</ol>
					</div>
				</div>
			</div>
			@if(!Auth::check())
			<div class="col-md-9 left-position">
				<div class="wrapbox border-radius-5">
					<form method="post" action="{{ URL::to('cart/getcheckout') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="txt_phone">Số điện thoại</label>
							<input id="txt_phone" class="txt-phone form-control" onkeypress='validate(event)' data-token="{{ csrf_token() }}" type="text" name="phone" value="" required>
							<i>(Tự động điền thông tin nếu bạn đã là khách hàng của Ohangveroi.com)</i>	
						</div>
						<div class="form-group">
							<label for="txt_name">Họ tên</label>
							<input id="txt_name" class="form-control" type="text" name="name" value="" required>	
						</div>
						<div class="form-group">
							<label for="txt_email">Email</label>
							<input id="txt_email" class="form-control" type="text" name="email" value="">	
						</div>
						<div class="form-group">
							<label for="txt_address">Địa chỉ giao hàng</label>
							<input id="txt_address" class="form-control" type="text" name="address" value="" required>	
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<select class="cmbCity selectpicker form-control border-radius-0" name="city" id="cmbCity" data-token="{{ csrf_token() }}" required>
										<option value="">Vui lòng chọn tỉnh/thành phố</option>
										@foreach($cities as $city)
										<option {{ $city->id == $currentCity ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->type . " " . $city->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<select class="cmbDistrict selectpicker form-control border-radius-0" name="district" id="cmbDistrict" data-token="{{ csrf_token() }}" required>
										@php
										$districtBelongItems = App\Models\District::where('province_id', $currentCity)->get();
										@endphp
										@foreach($districtBelongItems as $district)
										<option value="{{ $district->id }}">{{ $district->type . " " . $district->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="form-group text-right">
							<input class="btn btn-danger" name="submit" type="submit" value="Giao hàng địa chỉ này">
						</div>
					</form>
				</div>
			</div>
			@else
			<div class="col-md-9 left-position">
				<div class="wrapbox border-radius-5">
					<form method="post" action="{{ URL::to('cart/getcheckout') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="txt_phone">Số điện thoại</label>
							<input id="txt_phone" class="txt-phone form-control" onkeypress='validate(event)' data-token="{{ csrf_token() }}" type="text" name="phone" value="" required>
							<i>(Tự động điền thông tin nếu bạn đã là khách hàng của Ohangveroi.com)</i>	
						</div>
						<div class="form-group">
							<label for="txt_name">Họ tên</label>
							<input id="txt_name" class="form-control" type="text" name="name" value="{{ Auth::user()->name ? Auth::user()->name : Session::get('customername') }}" required>	
						</div>
						<div class="form-group">
							<label for="txt_email">Email</label>
							<input id="txt_email" class="form-control" type="text" name="email" value="{{ Auth::user()->name ? Auth::user()->email : Session::get('customeremail') }}">	
						</div>
						<div class="form-group">
							<label for="txt_address">Địa chỉ giao hàng</label>
							<input id="txt_address" class="form-control" type="text" name="address" value="{{ Auth::user()->address ? Auth::user()->address : Session::get('customeraddress') }}" required>	
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<select class="cmbCity selectpicker form-control border-radius-0" name="city" id="cmbCity" data-token="{{ csrf_token() }}" required>
										<option value="">Vui lòng chọn tỉnh/thành phố</option>
										@foreach($cities as $city)
										<option {{ $city->id == $currentCity ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->type . " " . $city->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<select class="cmbDistrict selectpicker form-control border-radius-0" name="district" id="cmbDistrict" data-token="{{ csrf_token() }}" required>
										@php
										$districtBelongItems = App\Models\District::where('province_id', $currentCity)->get();
										@endphp
										@foreach($districtBelongItems as $district)
										<option {{ $district->id == $currentDistrict ? 'selected' : '' }} value="{{ $district->id }}">{{ $district->type . " " . $district->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="form-group text-right">
							<input class="btn btn-danger border-radius-5 font-size-20" name="submit" type="submit" value="Giao hàng địa chỉ này">
						</div>
					</form>
				</div>
			</div>
			@endif
			<div class="col-md-3 small-right-position">
				<div class="row">
					<div class="col-xs-12">
						Đơn hàng ({{ Cart::count() }} sản phẩm) <a class="btn btn-default pull-right" href="{{ URL::to('cart/checkout/list') }}">Sửa</a>
					</div>
				</div>
				<hr>
				@foreach(Cart::content() as $item)
				<div class="row">
					<div class="col-md-8">
						{{ $item->qty }} x 
						<a class="linkInCard" target="_blank" href="{{ URL::to('product/'. $item->options->slug . '-' . $item->id) }}">{{ $item->name }}</a>
					</div>
					<div class="col-md-4 text-right">
						{{ product_price($item->price * $item->qty) }}
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				@endforeach
				<div class="alert alert-success border-radius-5">
					Tạm tính: <span class="total_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
					Phí vận chuyển: <span class="total_money shippingFee text-right pull-right">0đ</span><br>
					<!--get Customer-->
					@if ((Auth::check() && Auth::user()->id != 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
					Khuyến mãi: <span class="total_money text-right pull-right">- 5%</span>
					@endif
					<!--end Get Customer-->
					<hr>
					Thành tiền: <span class="final_money text-right pull-right">0đ</span><br>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var city_id = $('.cmbCity').val();
		var district_id = $('.cmbDistrict').val();
		var token = "{{ csrf_token() }}";
		getShippingFee(city_id, district_id, token);
	});
	$('.txt-phone').blur(function() {
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
				$('#txt_name').val(result.info.cus_name);
				$('#txt_address').val(result.info.cus_address);
				$('#txt_email').val(result.info.cus_email);
			}
		})			
		return false;
	})
	$('.cmbCity').change(function (){
		var city_id = $(this).val();
		var district_id = $('.cmbDistrict').val();
		var token = $(this).data('token');
		getShippingFee(city_id, district_id, token);
	})
	$('.cmbDistrict').change(function (){
		var city_id = $('.cmbCity').val();
		var district_id = $(this).val();
		var token = $(this).data('token');
		getShippingFee(city_id, district_id, token);
	})
	function getShippingFee(city_id, district_id, token) {
		$.ajax({
			url: _base_url + "/cart/checkout/shipping/calculatorfee",
			type: 'post',
			data: {
				cityId: city_id,
				districtId: district_id,
				_token: token
			}
		})
		.done(function(result) {
			if (!result.error) {
				$('.shippingFee').html(result.shippingFeeFormat + 'đ');
				$('.final_money').html(result.totalWithShippingFormat + 'đ');
			}
		})			
		return false;
	}
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
</script>
@stop
