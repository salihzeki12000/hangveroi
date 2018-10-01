@extends('layouts.app')
@section('content')
<div class="container-fluid mimin-wrapper">
	@include('admin.includes.left_menu')
	<!-- start: Content -->
	<div id="content">
		<div class="panel box-shadow-none content-header">
			<div class="panel-body">
				<div class="col-md-10">
					<h3 class="animated fadeInLeft">{!! $_nav_title !!}</h3>
					<p class="animated fadeInDown">
						{!! $_nav_title !!}
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading"><h3>{!! $_nav_title !!}</h3></div>
					<div class="panel-body">
						@if (Session::has('msg'))
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-success" role="alert">
									{{ Session::get('msg') }}
								</div>
							</div>
						</div>
						@endif
						<div class="responsive-table divForPrint">
							<h2>THÔNG TIN ĐƠN HÀNG ({{ date('d/m/Y', strtotime($articleItem->created_at)) }})</h2>
							<table id="datatables-example" class="table table-striped table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Thông tin thanh toán</th>
										<th>Địa chỉ giao hàng</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Khách hàng: {{ $articleItem->cus_name }}</td>
										<td>Khách hàng: {{ $articleItem->cus_name }}</td>
									</tr>
									@if($articleItem->cus_email != "")
									<tr>
										<td>Email: {{ $articleItem->cus_email }}</td>
										<td>Email: {{ $articleItem->cus_email }}</td>
									</tr>
									@endif
									<tr>
										<td>Số điện thoại: {{ $articleItem->cus_phone }}</td>
										<td>Số điện thoại: {{ $articleItem->cus_phone }}</td>
									</tr>
									<tr>
										<td></td>
										<td>Địa chỉ: {{ $articleItem->cus_address }}</td>
									</tr>
								</tbody>
							</table>
							<h2>THÔNG TIN CHI TIẾT</h2>
							<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Đơn giá</th>
										<th>Số lượng</th>
										<th>Tạm tính</th>
									</tr>
								</thead>
								<tbody>
									@php
									$orderItems = $articleItem->getOrderItems;
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
											<b>{{ $articleItem->total_price }} đ</b>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="text-right">
											<b>Phí vận chuyển</b>
										</td>
										<td class="text-right"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? '20,000 ₫' : 'Miễn phí' }}</b></td>
									</tr>
									<tr>
										<td colspan="3" class="text-right"><b>Tổng giá trị đơn hàng</b></td>
										<td class="text-right"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? number_format(str_replace(",", "", $articleItem->total_price) + 20000)  . ' ₫' : $articleItem->total_price . ' đ'}}</b></td>
									</tr>
								</tbody>
							</table>
						</div>
						<input type="text" class="form-control feeShip"><br>
						<input class="btn btn-danger printBill" type="button" value="Print Bill">
						<a class="btn btn-default" href="{{ URL::to('/admin/orders/edit/' . $articleItem->id) }}">Edit this order</a>
						<hr>
						<form action="" method="POST">
							<input type="hidden" name="order_id" value="{{ $articleItem->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group" style="margin-bottom:40px !important;">
								<textarea style=" width: 100%;" rows=5 name="note" required></textarea>
							</div>
							<select name="status" class="selectpicker form-control" data-id="{{ $articleItem->id }}" data-name="{{ $articleItem->cus_name }}" data-token="{{ csrf_token() }}" data-segment1="{{ Request::segment(1) }}">
								<option {{ $articleItem->status == 'new' ? 'selected' : '' }} value="new">Đơn hàng mới</option>
								<option {{ $articleItem->status == 'handle' ? 'selected' : '' }} value="handle">Đã xữ lý</option>
								<option {{ $articleItem->status == 'shipping' ? 'selected' : '' }} value="shipping">Đang giao hàng</option>
								<option {{ $articleItem->status == 'cancel' ? 'selected' : '' }} value="cancel">Đã hủy</option>
								<option {{ $articleItem->status == 'success' ? 'selected' : '' }} value="success">Thành công</option>
							</select>
							<div class="form-group" style="margin-top: 20px !important;">
								<input class="submit btn btn-danger" type="submit" value="Update Order">
							</div>
						</form>
						<div class="clearfix"></div>
						<h2>History</h2>
						@php
						$notes = $articleItem->getNotes;
						@endphp
						@foreach($notes as $note)
						<p>{!! $note->note !!} at {{ date('H:i d/m/Y', strtotime($note->created_at)) }}</p>
						@endforeach
						<p>Created at {{ date('H:i d/m/Y', strtotime($articleItem->created_at)) }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var URL = '{{ URL::to("/admin/orders/print/" . $articleItem->id) }}';
	$('.feeShip').on('keyup', function () {
		URL = '{{ URL::to("/admin/orders/print/" . $articleItem->id) }}' + '?feeShip=' + $(this).val();
	});
	$('.printBill').click(function() {
		var windowOpen = window.open(URL, "windowChild", "width=700, height=700");
		return false;
	});
</script>
@endsection
