<div style="font-family: Arial; font-size: 10px;">
	<div>
		Website: ohangveroi.com <br>
		Facebook: facebook.com/hangveroihcm <br>
		Phone: 0969 292 449 <br>
		Address: Đồng Tâm - Hóc Môn - TP HCM
	</div>
	<hr>
	<h2 style="font-size: 15px; margin-bottom: 0;">Thông tin đơn hàng ({{ date('d/m/Y', strtotime($articleItem->created_at)) }})</h2>
	<table border="1" cellspacing="0" cellpadding="0" style="width: 100%; font-size: 12px;">
		<tbody>
			<tr>
				<th align="left" style="padding: 5px; width: 50%">Thông tin thanh toán</th>
				<th align="left" style="padding: 5px; width: 50%">Địa chỉ giao hàng</th>
			</tr>
			<tr>
				<td style="padding: 5px;">Khách hàng: {{ $articleItem->cus_name }}</td>
				<td style="padding: 5px;">Khách hàng: {{ $articleItem->cus_name }}</td>
			</tr>
			@if($articleItem->cus_email != "" && $articleItem->cus_email != 'ntkimchau0707@gmail.com')
			<tr>
				<td style="padding: 5px;">Email: {{ $articleItem->cus_email }}</td>
				<td style="padding: 5px;">Email: {{ $articleItem->cus_email }}</td>
			</tr>
			@endif
			<tr>
				<td style="padding: 5px;">Số điện thoại: {{ $articleItem->cus_phone }}</td>
				<td style="padding: 5px;">Số điện thoại: {{ $articleItem->cus_phone }}</td>
			</tr>
			<tr>
				<td style="padding: 5px;"></td>
				<td style="padding: 5px;">Địa chỉ: {{ $articleItem->cus_address }}</td>
			</tr>
		</tbody>
	</table>
	<h2 style="font-size: 15px; margin-bottom: 0;">Thông tin đơn hàng #{{ $articleItem->id }}</h2>
	<table border="1" cellspacing="0" cellpadding="0" style="width: 100%; font-size: 12px;">
		<thead>
			<tr>
				<th align="left" style="padding: 5px;">Sản phẩm</th>
				<th align="left" style="padding: 5px;">Đơn giá</th>
				<th align="center" style="padding: 5px;">Số lượng</th>
				<th align="right" style="padding: 5px;">Tạm tính</th>
			</tr>
		</thead>
		<tbody>
			@php
			$orderItems = $articleItem->getOrderItems;
			@endphp
			@foreach($orderItems as $orderItem)
			<tr>
				<td align="left" style="padding: 5px;">{{ $orderItem->product_name }}</td>
				<td align="left" style="padding: 5px;">{{ number_format($orderItem->product_price) . 'đ' }}</td>
				<td align="center" style="padding: 5px;">{{ $orderItem->product_qty }}</td>
				<td align="right" style="padding: 5px;">{{ number_format($orderItem->product_price * $orderItem->product_qty) . 'đ' }}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="3" align="right" style="padding: 5px;">
					<b>Tạm tính</b>
				</td>
				<td align="right" style="padding: 5px;">
					<b>{{ $articleItem->total_price }}đ</b>
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right" style="padding: 5px;">
					<b>Phí vận chuyển</b>
				</td>
				<td align="right" style="padding: 5px;"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? '20,000₫' : 'Miễn phí' }}</b></td>
			</tr>
			<tr>
				<td colspan="3" align="right" style="padding: 5px;"><b>Tổng giá trị đơn hàng</b></td>
				<td align="right" style="padding: 5px;"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? number_format(str_replace(",", "", $articleItem->total_price) + 20000)  . '₫' : $articleItem->total_price . 'đ'}}</b></td>
			</tr>
		</tbody>
	</table>
	<div style="text-align: right; margin-top: 10px;">
		<i>Hoá đơn lập: {{ date('d/m/Y') }}</i>
	</div>
</div>
<script>
	window.print()
	window.close()
</script>