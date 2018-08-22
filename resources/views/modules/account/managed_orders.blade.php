@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li>Tài khoản của tôi</li>
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
				<div class="wrapListProduct">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Mã đơn hàng</th>
								<th>Ngày mua</th>
								<th>Sản phẩm</th>
								<th class="text-right">Tổng tiền</th>
								<th class="text-right">Trạng thái đơn hàng</th>
							</tr>
						</thead>
						<tbody>
							@if(count($orders) > 0)
							@foreach($orders as $order)
							@php
							$orderItems = $order->getOrderItems;
							$countItems = count($orderItems);
							@endphp
							<tr>
								<td>
									<a href="#">{{ $order->id }}</a>
								</td>
								<td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
								<td>
									@if ($countItems > 1)
									{{ $orderItems[0]->product_name }} ... và {{ $countItems - 1 }} sản phẩm khác.
									@else
									{{ $orderItems[0]->product_name }}
									@endif
								</td>
								<td class="text-right">{{ $order->total_price }} đ</td>
								<td class="text-right">{{ display_status($order->status) }}</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5">
									<p>Bạn chưa thực hiện đơn hàng nào thành công!</p>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-12 pull-right">
							{{ $orders->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
