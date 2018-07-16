@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
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
					<div class="col-md-3">
						<img class="img-thumbnail img-responsive" style="width: 100%" src="{{ $item->options->image }}" alt="{{ $item->name }}">
					</div>
					<div class="col-md-5">
						<b>{{ $item->name }}</b>
					</div>
					<div class="col-md-2">
						{{ product_price($item->price) }}
					</div>
					<div class="col-md-2">
						<select name="quantity" id="quantity" data-rowid="{{ $item->rowId }}" data-id="{{ $item->id }}" data-segment1="{{ Request::segment(1) }}" class="quantity selectpicker form-control quantity_{{ $item->id }}">
							@for( $i=1; $i <= 20; $i++ )
							@if($i == $item->qty)
							<option selected value="{{ $i }}">{{ $i }}</option>
							@else
							<option value="{{ $i }}">{{ $i }}</option>
							@endif
							@endfor
						</select>
					</div>
				</div>
				<div class="clearfix"></div>
				<br>
				@endforeach
				<hr>
				<a class="btn btn-default pull-right" href="{{ URL::to('/') }}">Tiếp tục mua sắm</a>
			</div>
			<div class="col-md-4">
				<div class="alert alert-success">
					Tổng tiền: <span class="total_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
					<hr>
					Thành tiền: <span class="final_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
				</div>
				<div class="row">
					<div class="col-sm-12">
						Phương thức thanh toán:<br><br>
						<input type="radio" class="payment1" id="payment1" name="paymentmethod" value="1" checked> Thanh toán tiền mặt khi nhận hàng. <br>
						<input type="radio" class="payment2" id="payment2" name="paymentmethod" value="2"> Thanh toán qua chuyển khoản ngân hàng.<br><br>
						<div class="bank_info alert alert-info">
							<b>Ngân hàng: Vietcombank</b><br>
							Chủ tài khoản: Nguyễn Thế Bảo <br>
							Số tài khoản: 0071005586830 <br><br>
							<b>Ngân hàng: Á Châu (ACB)</b><br>
							Chủ tài khoản: Nguyễn Thế Bảo <br>
							Số tài khoản: 174341219 <br>
						</div>
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
				</script>
				<a style="width:100%" href="{{ URL::to('cart/checkout') }}" class="btn btn-danger">Tiến hành đặt hàng</a>
			</div>
		</div>
	</div>
</div>
@stop