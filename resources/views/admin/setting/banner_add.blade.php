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
				</div> --}}
			</div>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12 padding-0">
				<form class="cmxform" id="signupForm" method="post" action="{{ Request::url() }}" enctype="multipart/form-data">
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>{{ trans('product.basic_info') }}</h4>
							</div>
							<div class="panel-body">
								<input type="hidden" id="id" value={{ $id }} name="id" required>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-md-12">
									<div class="form-group form-animate-text" style="">
										<input type="url" class="form-text" id="txt_url" value="{{ $url }}" name="url" required>
										<span class="bar"></span>
										<label>Url</label>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group form-animate-text" style="">
										<input type="text" class="form-text" id="txt_alt" value="{{ $alt }}" name="alt" required>
										<span class="bar"></span>
										<label>Alt</label>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group" style="margin-bottom:40px !important;">
										<input type="file" name="image" onchange="loadFile(event)">
										<script>
											var loadFile = function(event) {
												var output = document.getElementById('output');
												output.src = URL.createObjectURL(event.target.files[0]);
											};
										</script>
									</div>
								</div>
								<div class="col-sm-2">
									<img style="margin-bottom: 10px" width="100%" id="output" src="{{ $image }}" />
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Tuỳ chọn</h4>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12 padding-0">
										<div class="box-type col-sm-12">
											<div class="form-group" style="">
												<label>Location</label>
												<div class="col-sm-12 padding-0">
													<div class="col-sm-12 padding-0">
														<select name="location" class="selectpicker form-control">
															<option {{ $location == 'main_slider' ? 'selected' : '' }} value="main_slider">Main Slider</option>
															<option {{ $location == 'right_index_page' ? 'selected' : '' }} value="right_index_page">Right Index Banner</option>
															<option {{ $location == 'small_bottom_index_page' ? 'selected' : '' }} value="small_bottom_index_page">Small Logo Index Banner</option>
															<option {{ $location == 'big_bottom_index_page' ? 'selected' : '' }} value="big_bottom_index_page">Big Logo Index Banner</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="box-type col-sm-12">
											<div class="form-group" style="margin-bottom:40px !important;">
												<label>{{ trans('product.status') }}</label>
												<div class="col-sm-12 padding-0">
													<div class="col-sm-12 padding-0">
														<select name="status" class="selectpicker form-control">
															<option {{ $status ? "selected" : "" }} value="1">Pending</option>
															<option {{ $status ? "" : "selected" }} value="0">Published</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<input class="submit btn btn-danger" type="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
