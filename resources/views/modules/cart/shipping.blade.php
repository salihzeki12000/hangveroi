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
			@if(!Auth::check())
			<div class="col-md-5 left-position">
				<div class="wrapbox">
					<h4 class="h2-title alert alert-info">
						<i class="fa fa-user" aria-hidden="true"></i>&nbsp;Thông tin giao hàng
					</h4>
					<form method="post" action="{{ URL::to('cart/getcheckout') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="txt_name">Họ tên</label>
							<input id="txt_name" class="form-control" type="text" name="name" value="">	
						</div>
						<div class="form-group">
							<label for="txt_name">Địa chỉ giao hàng</label>
							<input id="txt_address" class="form-control" type="text" name="address" value="">	
						</div>
						<div class="form-group">
							<label for="txt_name">Số điện thoại</label>
							<input id="txt_phone" class="form-control" type="text" name="phone" value="">	
						</div>
						<div class="form-group text-right">
							<input class="btn btn-danger" name="submit" type="submit" value="Giao hàng địa chỉ này">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4 left-position">
				<div class="wrapbox">
					<h4 class="h2-title alert alert-info">
						<i class="fa fa-user" aria-hidden="true"></i>&nbsp;Đăng nhập
					</h4>
					<form method="post" action="{{ URL::to('account/login') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="txt_email">Tài khoản</label>
							<input id="txt_email" class="form-control" type="text" name="email" value="">	
						</div>
						<div class="form-group">
							<label for="txt_password">Mật khẩu</label>
							<input id="txt_password" class="form-control" type="password" name="password" value="">	
						</div>
						<div class="form-group text-right">
							<input class="btn btn-danger" name="submit" type="submit" value="Đăng nhập">
						</div>
					</form>
				</div>
			</div>
			@else
			<div class="col-md-9 left-position">
				<div class="wrapbox">
					<h4 class="h2-title alert alert-info">
						<i class="fa fa-user" aria-hidden="true"></i>&nbsp;Thông tin giao hàng
					</h4>
					<form method="post" action="{{ URL::to('cart/getcheckout') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="txt_name">Họ tên</label>
							<input id="txt_name" class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">	
						</div>
						<div class="form-group">
							<label for="txt_name">Địa chỉ giao hàng</label>
							<input id="txt_address" class="form-control" type="text" name="address" value="{{ Auth::user()->address }}">	
						</div>
						<div class="form-group">
							<label for="txt_name">Số điện thoại</label>
							<input id="txt_phone" class="form-control" type="text" name="phone" value="{{ Auth::user()->phone }}">	
						</div>
						<div class="form-group text-right">
							<input class="btn btn-danger" name="submit" type="submit" value="Giao hàng địa chỉ này">
						</div>
					</form>
				</div>
			</div>
			@endif
			<div class="col-md-3 small-right-position">
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
			</div>
		</div>
	</div>
</div>
@stop
