@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li>Đơn hàng của tôi</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-3 left-position">
				<div class="wrapmenu">
					<p class="margin-bottom-0">Tài khoản của</p>
					<h2 class="userNameLeft">{{ Auth::user()->name }}</h2>
					@include('account::layouts.left_menu')
				</div>
			</div>
			<div class="col-md-9 right-position">
				<div class="box-bg-xam order-detail margin-bottom-15">
					<div class="col-md-6">
						<div class="box-bg-white fix-height-180">
							<h3>Thông tin người nhận</h3>
							<p><b>{{ $order->cus_name }}</b></p>
							<p>Email: {{ $order->cus_email }}</p>
							<p>Phone: {{ $order->cus_phone }}</p>
							<p>Địa chỉ: {{ $order->cus_address }}</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box-bg-white fix-height-180">
							<h3>Hình thức thanh toán</h3>
							<p>Nhận tiền khi giao hàng</p>
							<p>Phí vận chuyển: {{ (str_replace(",", "", $order->total_price) < 100000) ? '20,000 ₫' : 'Miễn phí'}}</p>
						</div>
					</div>
				</div>
				<div class="wrapListProduct">
					<p>Trạng thái đơn hàng: <b>{{ display_status($order->status) }}</b></p>
					<hr>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tạm tính</th>
							</tr>
						</thead>
						<tbody>
							@php
							$orderItems = $order->getOrderItems;
							@endphp
							@foreach($orderItems as $orderItem)
							<tr>
								<td class="text-left">{{ $orderItem->product_name }}</td>
								<td class="text-left">{{ number_format($orderItem->product_price) . ' đ' }}</td>
								<td class="text-center">{{ $orderItem->product_qty }}</td>
								<td class="text-right">{{ number_format($orderItem->product_price * $orderItem->product_qty) . ' đ' }}</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="3" class="text-right">
									<b>Tạm tính</b>
								</td>
								<td class="text-right">
									<b>{{ $order->total_price }} đ</b>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">
									<b>Phí vận chuyển</b>
								</td>
								<td class="text-right"><b>{{ (str_replace(",", "", $order->total_price) < 100000) ? '20,000 ₫' : 'Miễn phí' }}</b></td>
							</tr>
							<tr>
								<td colspan="3" class="text-right"><b>Tổng giá trị đơn hàng</b></td>
								<td class="text-right"><b>{{ (str_replace(",", "", $order->total_price) < 100000) ? number_format(str_replace(",", "", $order->total_price) + 20000)  . ' ₫' : $order->total_price . ' đ'}}</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
