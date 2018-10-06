@extends('layouts.app')
@section('content')
<div class="container-fluid mimin-wrapper">
	@include('admin.includes.left_menu')
	<!-- start: Content -->
	<div id="content">
		<div class="panel box-shadow-none content-header">
			<div class="panel-body">
				<div class="col-md-10">
					<h3 class="animated fadeInLeft">{{ $_nav_title }}</h3>
					<p class="animated fadeInDown">
						{{ $_nav_title }}
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			@php
			$order = new App\Models\Order();
			@endphp
			<table class="table table-reponsive table-bordered">
				<tbody>
					<tr>
						<td class="text-center">Doanh thu hôm nay</td>
						<td class="text-center">Doanh thu tháng <b>{{ date('m') }}</b></td>
						<td class="text-center">Doanh thu tháng <b>{{ date('m', strtotime(date('Y-m').' -1 month')) }}</b></td>
					</tr>
					<tr>
						<td class="text-center">
							{{ number_format($order->getTotalOrderByDay(date('Y-m-d'))) }} VNĐ
						</td>
						<td class="text-center">
							{{ number_format($order->getTotalMoneyByMonth(date('m'))) }} VNĐ
						</td>
						<td class="text-center">
							{{ number_format($order->getTotalMoneyByMonth(date('m', strtotime(date('Y-m').' -1 month')))) }} VNĐ
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading"><h3>{{ $_nav_title }}</h3></div>
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
						<div class="responsive-table">
							<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Purcharer</th>
										<th>Note</th>
										<th>Items</th>
										<th>Total Price</th>
										<th>Date ordered</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($articleItems as $item)
									<tr id="article-{{ $item['id'] }}">
										<td>{{ $item['id'] }}</td>
										<td>
											{{ $item['cus_name'] }} <br>
											@if($item['cus_email'] != "")
											{{ $item['cus_email'] }} <br>
											@endif
											{{ $item['cus_phone'] }} <br>
											{{ $item['cus_address'] }}
										</td>
										<td>{{ $item['note'] }}</td>
										<td>
											@php
											$orderItems = $item->getOrderItems;
											@endphp
											@foreach($orderItems as $orderItem)
											{{ $orderItem->product_name }} - <b>({{ $orderItem->product_qty }})</b> <br/>
											@endforeach
										</td>
										<td>{{ product_price(str_replace(',', '', $item['total_price'])) }}</td>
										<td>{{ $item['created_at'] }}</td>
										<td>
											@if ($item->status == 'new')
											<span class="label label-danger">Đơn hàng mới</span>
											@elseif ($item->status == 'shipping')
											<span class="label label-warning">Đang giao hàng</span>
											@elseif ($item->status == 'cancel')
											<span class="label label-default">Đã hủy</span>
											@elseif ($item->status == 'handle')
											<span class="label label-info">Đã xữ lý</span>
											@elseif ($item->status == 'success')
											<span class="label label-success">Thành công</span>
											@endif
										</td>
										<td>
											<a href="{{ admin_link_helper('view', $item['id']) }}">
												<span style="padding: 0px 10px" class="btn btn-outline btn-primary">View <span class="fa fa-eye"></span></span>
											</a>
											<a href="{{ admin_link_helper('edit', $item['id']) }}">
												<span style="padding: 0px 10px" class="btn btn-outline btn-warning">Edit <span class="fa fa-pencil"></span></span>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function(){
			$('#datatables-example').DataTable({
				"order": [[ 0, "desc" ]]
			} );
		});

	</script>
	<!-- end: content -->
	@include('admin.includes.right_menu')
</div>
@endsection