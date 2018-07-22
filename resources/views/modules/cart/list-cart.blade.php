@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<form method="post" action="{{ URL::to('cart/checkout') }}">
				{{ csrf_field() }}
				<div class="col-md-8">
					<h2 class="h2-title alert alert-danger">
						<i class="fa fa-user" aria-hidden="true"></i> Giỏ hàng của bạn
					</h2>
					<div class="alert alert-warning">
						<div class="row">
							<div class="col-md-8">
								Giỏ hàng có 	<b>{{ Cart::count() }}</b> sản phẩm
							</div>
							<div class="col-md-2">
								Giá mua
							</div>
							<div class="col-md-2">
								Số lượng
							</div>
						</div>
					</div>
					@foreach(Cart::content() as $item)
					<div class="row">
						<div class="col-md-2">
							<img class="img-thumbnail img-responsive" style="width: 100%" src="{{ $item->options->image }}" alt="{{ $item->name }}">
						</div>
						<div class="col-md-6">
							<b>{{ $item->name }}</b>
						</div>
						<div class="col-md-2">
							{{ product_price($item->price) }}
						</div>
						<div class="col-md-2">
							{{ $item->qty }}
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					@endforeach
					<a class="btn btn-default pull-right" href="{{ URL::to('/') }}">Tiếp tục mua sắm</a>
				</div>
				<div class="col-md-4 small-right-position">
					<h4>Địa chỉ giao hàng</h4>

					<hr>
					Đơn hàng ({{ Cart::count() }} sản phẩm) <a class="btn btn-default pull-right" href="{{ URL::to('cart/checkout/list') }}">Sửa đơn hàng</a>
					<hr>
					@foreach(Cart::content() as $item)
					<div class="row">
						<div class="col-md-8">
							{{ $item->qty }} x 
							<a class="linkInCard" target="_blank" href="{{ URL::to('product/'. $item->options->slug . '-' . $item->id) }}">{{ $item->name }}</a>
						</div>
						<div class="col-md-4">
							{{ product_price($item->price * $item->qty) }}
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					@endforeach
					<div class="alert alert-success">
						Tạm tính: <span class="total_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
						<hr>
						Thành tiền: <span class="final_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
					</div>
					<div class="row">
						<div class="col-sm-12">
							Phương thức thanh toán:<br><br>
							<input type="radio" class="payment1" id="payment1" name="paymentmethod" value="1" checked> Thanh toán tiền mặt khi nhận hàng. <!-- <br>
							<input type="radio" class="payment2" id="payment2" name="paymentmethod" value="2"> Thanh toán qua chuyển khoản ngân hàng.<br><br>
							<div class="bank_info alert alert-info">
								<b>Ngân hàng: Vietcombank</b><br>
								Chủ tài khoản: Nguyễn Thế Bảo <br>
								Số tài khoản: 0071005586830 <br><br>
								<b>Ngân hàng: Á Châu (ACB)</b><br>
								Chủ tài khoản: Nguyễn Thế Bảo <br>
								Số tài khoản: 174341219 <br>
							</div> -->
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
				<input style="width:100%" type="submit" name="submit" class="btn btn-danger" value="Tiến hành đặt hàng">
			</form>
		</div>
	</div>
</div>
@stop