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
				<div class="col-md-2">
					<a href="{{ admin_link_helper('create', '', '/banner') }}">
						<h3 class="animated fadeInLeft">
							<button class="btn ripple btn-raised btn-danger">
								<div>
									<span>Add new</span>
									<span class="ink animate" style="height: 182px; width: 182px; top: -78px; left: 18px;"></span>
								</div>
							</button>
						</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading"><h3>{{ $_nav_title }}</h3></div>
					<div class="panel-body">
						<div class="responsive-table">
							<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Image</th>
										<th>Alt</th>
										<th>Location</th>
										<th>Date Added</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($articleItems as $item)
									<tr id="article-{{ $item['id'] }}">
										<td>{{ $item->id }}</td>
										<td>
											<?php
											$image = '';
											if($item->image != 0)
											{
												if (!empty(App\Models\Gallery::find($item->image))) {
													$image  = App\Models\Base::get_upload_url($item->getImage->filename);
												}
											}
											?>
											<img src="{{ $image }}" style="width: 100px;">
										</td>
										<td>{{ $item->alt }}</td>
										<td>{{ $item->location }}</td>
										<td>{{ $item->created_at }}</td>
										<td>
											<a class="changeStatus" data-segment1="{{ Request::segment(1) }}" data-segment2="{{ Request::segment(2) }}" data-segment3="{{ Request::segment(3) }}" data-name="{{ $item['name'] }}" data-token="{{ csrf_token() }}" data-id="{{ $item['id'] }}" href="{{ admin_link_helper('status', $item['id'], '/banner') }}">
												@if($item->trashed())
												<span class="btn btn-outline btn-danger" style="width: 100px;">Pending <span class="fa fa-times"></span></span>
												@else
												<span class="btn btn-outline btn-success" style="width: 100px;">Published <span class="fa fa-check"></span></span>
												@endif
											</a>
											&nbsp;
											<a href="{{ admin_link_helper('edit', $item['id'], '/banner') }}">
												<span class="btn btn-outline btn-primary">Edit <span class="fa fa-pencil"></span></span>
											</a>
											&nbsp;
											<a class="deleleItem" data-segment1="{{ Request::segment(1) }}" data-segment2="{{ Request::segment(2) }}" data-segment3="{{ Request::segment(3) }}" data-name="{{ $item['name'] }}" data-token="{{ csrf_token() }}" data-id="{{ $item['id'] }}" href="{{ admin_link_helper('delete', $item['id'], '/banner') }}">
												<span class="btn btn-outline btn-primary">Delete <span class="fa fa-trash"></span></span>
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
@stop
