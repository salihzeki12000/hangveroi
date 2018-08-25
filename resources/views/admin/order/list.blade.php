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
				{{-- <div class="col-md-2">
					<a href="{{ admin_link_helper('create') }}">
						<h3 class="animated fadeInLeft">
							<button class="btn ripple btn-raised btn-danger">
								<div>
									<span>Add new</span>
									<span class="ink animate" style="height: 182px; width: 182px; top: -78px; left: 18px;"></span>
								</div>
							</button>
						</h3>
					</a>
				</div> --}}
			</div>
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
										<th>Phone number</th>
										<th>Quantity</th>
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
										<td>{{ $item['cus_name'] }}</td>
										<td>{{ $item['cus_phone'] }}</td>
										<td>{{ $item['qty'] }}</td>
										<td>{{ product_price(str_replace(',', '', $item['total_price'])) }}</td>
										<td>{{ $item['created_at'] }}</td>
										<td>
											@if ($item->status == 'new')
											<span class="label label-danger">Đơn hàng mới</span>
											@elseif ($item->status == 'shipping')
											<span class="label label-warning">Đang giao hàng</span>
											@elseif ($item->status == 'cancel')
											<span class="label label-default">Đã hủy</span>
											@elseif ($item->status == 'success')
											<span class="label label-success">Thành công</span>
											@endif
										</td>
										<td>
											<a href="{{ admin_link_helper('view', $item['id']) }}">
												<span class="btn btn-outline btn-primary">View <span class="fa fa-eye"></span></span>
											</a>
											<!-- &nbsp;
											<a class="deleleItem" data-segment1="{{ Request::segment(1) }}" data-segment2="{{ Request::segment(2) }}" data-name="{{ $item['name'] }}" data-token="{{ csrf_token() }}" data-id="{{ $item['id'] }}" href="{{ admin_link_helper('delete', $item['id']) }}">
												<span class="btn btn-outline btn-primary">Delete <span class="fa fa-trash"></span></span>
											</a> -->
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