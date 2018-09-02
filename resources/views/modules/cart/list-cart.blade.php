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
						<li class="active">Giỏ hàng của bạn</li>
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
					<div class="progress-bar progress-bar-striped progress-bar-danger active" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width:33.3%">
						Tiến hành đặt hàng
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<form method="post" action="{{ URL::to('cart/checkout') }}">
				{{ csrf_field() }}
				<div class="col-md-8">
					<div class="alert alert-warning">
						<div class="row">
							<div class="col-md-4 col-xs-12">
								<b>Giỏ hàng có 	<b>{{ Cart::count() }}</b> sản phẩm</b>
							</div>
							<div class="col-md-2 col-xs-3">
								<b>Giá</b>
							</div>
							<div class="col-md-2 col-xs-3">
								<b>Giảm giá</b>
							</div>
							<div class="col-md-2 col-xs-3">
								<b>Giảm còn</b>
							</div>
							<div class="col-md-2 col-xs-3">
								<b>Số lượng</b>
							</div>
						</div>
					</div>
					@foreach(Cart::content() as $item)
					<div class="row">
						<div class="col-md-1 col-xs-4">
							<img class="img-thumbnail img-responsive" style="width: 100%" src="{{ $item->options->image }}" alt="{{ $item->name }}">
						</div>
						<div class="col-md-3 col-xs-8">
							<a class="linkInCard font-size-15" target="_blank" href="{{ URL::to('product/'. $item->options->slug . '-' . $item->id) }}">{{ $item->name }}</a>
							<p class="margin-bottom-0">{{ $item->options->category }}</p>
							<p class="margin-top-0"><a href="{{ URL::to('cart/remove/' . $item->rowId) }}">Xóa</a></p>
						</div>
						<div class="col-md-2 col-xs-3">
							{{ product_price($item->options->price_real) }}
						</div>
						<div class="col-md-2 col-xs-3">
							{{ $item->options->discount }}%
						</div>
						<div class="col-md-2 col-xs-3">
							{{ product_price($item->price) }}
						</div>
						<div class="col-md-2 col-xs-3">
							{{ $item->qty }}
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					@endforeach
					<div class="row">
						<div class="col-xs-12">
							<a class="btn btn-default pull-right border-radius-5" href="{{ URL::to('/') }}">Tiếp tục mua sắm</a>
						</div>
					</div><br>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-4 small-right-position">
					<div class="row">
						<div class="col-xs-12">
							<div class="alert alert-warning">
								<h4 class="margin-0">Địa chỉ giao hàng</h4>
							</div>
							<h5>{{ Session::get('customername') }}</h5>
							@if (Session::get('customeremail') != "")
							<p>{{ Session::get('customeremail') }}</p>
							@endif
							<p>{{ Session::get('customerphone') }}</p>
							<p>{{ Session::get('customeraddress') }}</p>
							<a class="btn btn-default pull-right" href="{{ URL::to('cart/checkout/shipping') }}">Sửa</a>
						</div>
					</div>
					<hr>
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
					<div class="alert alert-success">
						Tạm tính: <span class="total_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
						@if (str_replace(",", "", Cart::subtotal()) < 100000)
						Phí vận chuyển: <span class="total_money text-right pull-right">20,000đ</span><br>
						@endif
						<!--get Customer-->
						@if ((Auth::check() && Auth::user()->id != 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
						Khuyến mãi: <span class="total_money text-right pull-right">- 10%</span>
						@endif
						<!--end Get Customer-->
						<hr>
						@if ((Auth::check() && Auth::user()->id != 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
						@php
						$total = str_replace(",", "", Cart::subtotal());
						if ($total < 100000)
						{
							$total += 20000;
						}
						$totalDown10 = $total * 0.1;
						@endphp
						Thành tiền: <span class="final_money text-right pull-right">{{ number_format($total - $totalDown10) }}đ</span><br>
						@else
						Thành tiền: <span class="final_money text-right pull-right">{{ (str_replace(",", "", Cart::subtotal()) < 100000) ? number_format(str_replace(",", "", Cart::subtotal()) + 20000) : Cart::subtotal() }}đ</span><br>
						@endif
					</div>
					<div class="row">
						<div class="col-sm-12">
							Phương thức thanh toán:<br>
							<input type="radio" class="payment1" id="payment1" name="paymentmethod" value="1" checked> Thanh toán tiền mặt khi nhận hàng.
							{{-- <br>
								<input type="radio" class="payment2" id="payment2" name="paymentmethod" value="2"> Thanh toán qua chuyển khoản ngân hàng.<br><br>
								<div class="bank_info alert alert-info border-radius-5">
									<b>Ngân hàng: Vietcombank</b><br>
									Chủ tài khoản: Nguyễn Thế Bảo <br>
									Số tài khoản: 0071005586830 <br><br>
									<b>Ngân hàng: Á Châu (ACB)</b><br>
									Chủ tài khoản: Nguyễn Thế Bảo <br>
									Số tài khoản: 174341219 <br>
								</div> --}}
							</div>
						</div>
						<style>
						.bank_info { display: none }
					</style>
					<script>
						$('.payment2').click(function() {
							if($('#payment2').is(':checked')) { 
								$('.bank_info').css('display', 'block');
							}
						});
						$('.payment1').click(function() {
							if($('#payment1').is(':checked')) { 
								$('.bank_info').css('display', 'none');
							}
						});
					</script><hr>
					<input style="width:100%" type="submit" name="submit" class="btn btn-danger border-radius-5 font-size-20" value="Tiến hành đặt hàng">
				</form>
			</div>
		</div>
	</div>
	@stop