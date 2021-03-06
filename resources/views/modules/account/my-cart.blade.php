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
			<!-- <div class="col-md-3 left-position">
				<div class="wrapmenu">
					<div class="row infoAccountLeft">
						<div class="col-xs-2">
							<i class="fa fa-user fa-3x"></i>
						</div>
						<div class="col-xs-10">
							<p>Giỏ hàng của</p>
							<h2>{{-- Auth::user()->name --}}</h2>
						</div>
					</div>
					<ul class="parent">
						<li><i class="fa fa-user"></i>&nbsp;<a href="{{ URL::to('account/information') }}">Thông tin tài khoản</a></li>
						<li><i class="fa fa-th-list"></i>&nbsp;<a href="{{ URL::to('account/ordered') }}">Quản lý đơn hàng</a></li>
					</ul>
				</div>
			</div> -->
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
			<div class="col-xs-12">
				<div class="progress border-radius-5">
					<div class="progress-bar progress-bar-striped progress-bar-danger active" aria-valuenow="33.3" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width:33.3%">
						Giỏ hàng
					</div>
					<div class="progress-bar" role="progressbar" style="width:33.3%; background: #f5f6f7; color: #666">
						Cập nhật giao hàng
					</div>
					<div class="progress-bar" role="progressbar" style="width:33.3%; background: #f5f6f7; color: #666">
						Tiến hành đặt hàng
					</div>
				</div>
			</div>
			<div class="col-md-9 right-position">
				<div class="alert alert-warning myCard border-radius-5">
					<div class="row">
						<div class="col-md-4 col-xs-12">
							<b>Giỏ hàng có 	<b>{{ Cart::count() }}</b> sản phẩm</b>
						</div>
						<div class="col-md-2 col-xs-3">
							<b>Giá sản phẩm</b>
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
					<hr>
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
							<input type="number" name="quantity" id="quantity" data-rowid="{{ $item->rowId }}" data-id="{{ $item->id }}" data-segment1="{{ Request::segment(1) }}" class="quantity selectpicker form-control quantity_{{ $item->id }}" value="{{ $item->qty }}">
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					@endforeach
				</div>
				<a class="btn btn-default pull-right border-radius-5" href="{{ URL::to('/') }}">Tiếp tục mua sắm</a>
			</div>
			<div class="col-md-3">
				<div class="alert alert-success border-radius-5">
					Tạm tính: <span class="total_money text-right pull-right">{{ Cart::subtotal() }}đ</span><br>
					<!--get Customer-->
					@if ((Auth::check() && Auth::user()->id != 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
					Khuyến mãi: <span class="total_money text-right pull-right">- 5%</span>
					@endif
					<!--end Get Customer-->
					<hr>
					@if ((Auth::check() && Auth::user()->id != 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
					@php
					$total = str_replace(",", "", Cart::subtotal());
					$totalDown10 = $total * 0.05;
					$finalTotal = $total - $totalDown10;
					@endphp
					Thành tiền: <span class="final_money text-right pull-right">{{ number_format($finalTotal) }}đ</span><br>
					@else
					Thành tiền: <span class="final_money text-right pull-right">{{ number_format(str_replace(",", "", Cart::subtotal())) }}đ</span><br>
					@endif
				</div>
				<a style="width:100%" href="{{ URL::to('cart/checkout/shipping') }}" class="btn btn-danger border-radius-5 font-size-20">Mua hàng</a>
			</div>
		</div>
	</div>
</div>
@stop