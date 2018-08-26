<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="width: 600px; font-family: Arial; font-size: 12px; border: 1px solid #666;">
	<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
	<table style="width: 100%">
		<thead>
			<tr>
				<th colspan="2">
					<div style="background: #0c5f44; width: 100%; display: block; overflow: hidden;">
						<a href="http://ohangveroi.com">
							<img style="width: 200px; float: left; padding: 10px" src="https://ohangveroi.com/assets/img/logo.png">
						</a>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2" style="padding: 5px;">
					<b><p>Cảm ơn quý khách {{ $cus_name }} đã đặt hàng tại Ohangveroi.com,</p></b>
					<p>Ohangveroi.com rất vui thông báo đơn hàng #{{ $order_id }} của quý khách đã được tiếp nhận và đang trong quá trình xữ lý. Ohangveroi sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding: 5px;">
					<b style="color: #0c5f44"><p style="margin: 0;">THÔNG TIN ĐƠN HÀNG #{{ $order_id }} <i>{{ 'Ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y') }}</i></p></b>
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					<b><p style="margin: 0;">Thông tin thanh toán</p></b>
					{{ $cus_name }} <br>
					{{ $cus_email }} <br>
					{{ $cus_phone }} <br>
				</td>
				<td style="padding: 5px;">
					<b><p style="margin: 0;">Địa chỉ giao hàng</p></b>
					{{ $cus_name }} <br>
					{{ $cus_email }} <br>
					{{ $cus_address }} <br>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding: 5px;">
					<b>Phương thức thanh toán:</b> Tiền mặt khi nhận hàng <br>
					<b>Thời gian giao hàng dự kiến:</b> dự kiến giao hàng trước 19:00 {{ date('H') <= 12 ? ' hôm nay.' : ' ngày ' . date('d-m-Y', strtotime(' +1 day')) }} <br>
					<!--get Customer-->
					@if ((Auth::check() && Auth::user()->id == 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
					<b>Khuyến mãi:</b> - 10% <br>
					@endif
					<!--end Get Customer-->
					@if (str_replace(",", "", $cart_total_price) < 100000)
					Phí vận chuyển: <span class="total_money text-right pull-right">20,000 đ</span>
					@endif

				</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<p style="margin: 0; padding: 5px;"><b>CHI TIẾT ĐƠN HÀNG</b></p>
	<div style="padding: 5px;">
		<table style="width: 100%; border-color: #f5f6f7;" border="1" cellspacing="0" cellpadding="0">
			<thead>
				<tr style="background: #0c5f44; color: #fff;">
					<th style="padding: 5px 0">Sản phẩm</th>
					<th style="padding: 5px 0">Đơn giá</th>
					<th style="padding: 5px 0">Số lượng</th>
					<th style="padding: 5px 0">Tổng tạm</th>
				</tr>
			</thead>
			<tbody>
				@foreach($carts as $cart)
				<tr>
					<td style="padding: 5px;">{{ $cart->name }}</td>
					<td style="padding: 5px;">{{ number_format($cart->price) . ' ₫' }}</td>
					<td style="padding: 5px;">{{ $cart->qty }}</td>
					<td style="text-align: right;">{{ number_format($cart->price * $cart->qty) . ' ₫' }}</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="3" style="text-align: right;padding: 5px;">Tổng tạm tính</td>
					<td style="text-align: right;">{{ $cart_total_price . ' ₫' }}</td>
				</tr>
				@if ((Auth::check() && Auth::user()->id == 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
				<tr>
					<td colspan="3" style="text-align: right;padding: 5px;">Khuyến mãi</td>
					<td style="text-align: right;">10%</td>
				</tr>
				@endif
				<tr>
					<td colspan="3" style="text-align: right;padding: 5px;">Phí vận chuyển</td>
					<td style="text-align: right;">
						{{ (str_replace(",", "", $cart_total_price) < 100000) ? '20,000 đ' : 'Miễn phí' }}
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: right;padding: 5px;">Tổng giá trị đơn hàng</td>
					@if ((Auth::check() && Auth::user()->id == 1) && App\Models\Setting::where('key', 'first_customers')->first()["value"] == 1)
					@php
					$total = str_replace(",", "", $cart_total_price);
					$totalDown10 = $total * 0.1;
					@endphp
					<td style="text-align: right;">{{ ($total < 100000) ? number_format(($total + 20000) - $totalDown10)  . ' ₫' : $total + $totalDown10 . ' đ'}}</td>
					@else
					<td style="text-align: right;">{{ (str_replace(",", "", $cart_total_price) < 100000) ? number_format(str_replace(",", "", $cart_total_price) + 20000)  . ' ₫' : $cart_total_price . ' đ'}}</td>
					@endif
				</tr>
			</tbody>
		</table>
	</div>
	<hr>
	<table style="width: 100%;">
		<thead>
			<tr>
				<th colspan="2">
					<div style="background: #0c5f44; width: 100%; display: block; overflow: hidden; color: #fff; text-align: left;">
						<p style="padding: 0 5px;">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể liên hệ trực tiếp HOTLINE: <b>0969 292 449</b> để được tư vấn nhanh nhất</p>
						<p style="margin: 0; padding: 0 5px 20px 5px;"><b>Một lần nữa Ohangveroi.com cảm ơn quý khách.</b></p>
					</div>
				</th>
			</tr>
		</thead>
	</table>
</body>
</html>