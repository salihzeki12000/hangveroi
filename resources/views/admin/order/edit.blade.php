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
						<form action="" method="POST">
							<input type="hidden" name="order_id" value="{{ $articleItem->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="responsive-table divForPrint">
								<h2>THÔNG TIN ĐƠN HÀNG ({{ date('d/m/Y', strtotime($articleItem->created_at)) }})</h2>
								<table id="datatables-example" class="table table-striped table-hover" width="100%" cellspacing="0">
									<tbody>
										<tr>
											<td>Khách hàng</td>
											<td><input type="text" class="form-control" name="cus_name" value="{{ $articleItem->cus_name }}"></td>
										</tr>
										<tr>
											<td>Email</td>
											<td><input type="email" class="form-control" name="cus_email" value="{{ $articleItem->cus_email }}"></td>
										</tr>
										<tr>
											<td>Số điện thoại</td>
											<td><input type="text" class="form-control" name="cus_phone" value="{{ $articleItem->cus_phone }}"></td>
										</tr>
										<tr>
											<td>Địa chỉ</td>
											<td><input type="text" class="form-control" name="cus_address" value="{{ $articleItem->cus_address }}"></td>
										</tr>
									</tbody>
								</table>
								<div class="form-group" style="margin-top: 20px !important;">
									<input class="submit btn btn-danger" type="submit" value="Update Order">
								</div>
								<h2>THÔNG TIN CHI TIẾT</h2>
								<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Sản phẩm</th>
											<th>Đơn giá</th>
											<th class="text-center">Số lượng</th>
											<th class="text-right">Tạm tính</th>
											<th class="text-right">Hành động</th>
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
											<td class="text-center">
												<input class="form-control updateQty qty-row-{{ $orderItem->id }}" type="text" value="{{ $orderItem->product_qty }}" data-row="{{ $orderItem->id }}">
											</td>
											<td class="text-right">{{ number_format($orderItem->product_price * $orderItem->product_qty) . ' đ' }}</td>
											<td class="text-right">
												<button type="button" class="updateAction update-row-{{ $orderItem->id }}" data-row="{{ $orderItem->id }}" data-token="{{ csrf_token() }}" disabled>Update</button>
												<!-- <button type="button" class="removeAction remove-row-{{ $orderItem->id }}" data-row="{{ $orderItem->id }}" data-token="{{ csrf_token() }}" disabled>Remove</button> -->
											</td>
										</tr>
										@endforeach
										<tr>
											<td colspan="3" class="text-right">
												<b>Tạm tính</b>
											</td>
											<td class="text-right">
												<b>{{ $articleItem->total_price }} đ</b>
											</td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3" class="text-right">
												<b>Phí vận chuyển</b>
											</td>
											<td class="text-right"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? '20,000 ₫' : 'Miễn phí' }}</b></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3" class="text-right"><b>Tổng giá trị đơn hàng</b></td>
											<td class="text-right"><b>{{ (str_replace(",", "", $articleItem->total_price) < 100000) ? number_format(str_replace(",", "", $articleItem->total_price) + 20000)  . ' ₫' : $articleItem->total_price . ' đ'}}</b></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.updateQty').on('change', function() {
		var rowId = $(this).data('row');
		$('.update-row-' + rowId).removeAttr('disabled').addClass('btn-danger');
	});
	$(".updateAction").click(function() {
		var rowId = $(this).data('row');
		var qty = $('.qty-row-' + rowId).val();
		var token = $(this).data('token');
		if (qty == "") {
			qty = 0;
		}
		$.ajax({
			url: _base_url + "admin/order-item/update",
			type: 'post',
			data: {
				id: rowId,
				qty: qty,
				_token: token
			}
		})
		.done(function(result) {
			if (result.status == true) {
				location.reload();
			}
		})
		.fail(function() {
			BootstrapDialog.show({
				type: BootstrapDialog.TYPE_DANGER,
				title: 'Error',
				message: 'Connection error'
			});
		});				
		return false;
	});
	$(".removeAction").click(function() {
		var rowId = $(this).data('row');
		console.log(rowId);
	});
</script>
@endsection
