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
						<div class="responsive-table">
							<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Thông tin khách hàng</th>
										<th>Chi tiết đơn hàng</th>
										<th>Tổng số tiền</th>
										<th>Trạng thái đơn hàng</th>
									</tr>
								</thead>
								<tbody>
									<tr id="article-{{ $articleItem->id }}">
										<td>
											<b>{{ $articleItem->cus_name }}</b><br>
											{{ $articleItem->cus_phone }}<br>
											{{ $articleItem->cus_address }}
										</td>
										<td>
											@foreach($orderItemDetails as $item)
											{{ $item->product_qty }} x {{ $item->product_name }} ({{ number_format($item->product_price) }} VNĐ) <br>
											@endforeach
										</td>
										<td>{{ $articleItem->total_price }} VNĐ</td>
										<td>
											{{ $articleItem->status }}
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="" method="POST">
							<input type="hidden" name="order_id" value="{{ $articleItem->id }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group" style="margin-bottom:40px !important;">
								<textarea class="editor1" name="note"><?php  ?></textarea>
							</div>
							<select name="status" class="selectpicker form-control" data-id="{{ $articleItem->id }}" data-name="{{ $articleItem->cus_name }}" data-token="{{ csrf_token() }}" data-segment1="{{ Request::segment(1) }}">
								<option {{ $articleItem->status == 'new' ? 'selected' : '' }} value="new">Đơn hàng mới</option>
								<option {{ $articleItem->status == 'shipping' ? 'selected' : '' }} value="shipping">Đang giao hàng</option>
								<option {{ $articleItem->status == 'cancel' ? 'selected' : '' }} value="cancel">Đã hủy</option>
								<option {{ $articleItem->status == 'success' ? 'selected' : '' }} value="success">Thành công</option>
							</select>
							<div class="form-group" style="margin-top: 20px !important;">
								<input class="submit btn btn-danger" type="submit" value="Update Order">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src={{ URL::to('plugins/froala_editor/js/plugins/align.min.js') }}></script>
<script src={{ URL::to('plugins/froala_editor/js/plugins/quote.min.js') }}></script>
<script src={{ URL::to('plugins/froala_editor/js/plugins/link.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/emoticons.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/emoticons.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/colors.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/colors.min.js') }}></script>
<script src={{ URL::to('plugins/froala_editor/js/plugins/font_size.min.js') }}></script>
<script src={{ URL::to('plugins/froala_editor/js/plugins/font_family.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/table.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/table.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/video.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/video.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/image.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/image.min.js') }}></script>
<link rel="stylesheet" href={{ URL::to('plugins/froala_editor/css/plugins/image_manager.min.css') }} />
<script src={{ URL::to('plugins/froala_editor/js/plugins/image_manager.min.js') }}></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.editor1').froalaEditor({
			height: 200,
			toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', '-', 'insertLink', 'insertTable', 'undo', 'redo', 'clearFormatting', 'html']
		});
	});
	$(".changeOrderStatus").change(function() {
		var that = $(this);
		var id = $(this).data('id');
		var title = $(this).data('name');
		var status = $(this).val();
		var token = $(this).data('token');
		var segment1 = $(this).data('segment1');

		$.ajax({
			url: _base_url + segment1 + "/orders/change",
			type: 'post',
			data: {
				id: id,
				status: status,
				_token: token
			}
		})
		.done(function(result) {
			if (result.error) {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_DANGER,
					title: 'Error',
					message: 'Connection error'
				});
			} else {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_SUCCESS,
					title: 'Success',
					message: 'The status has been changed!'
				});
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
</script>
@endsection
