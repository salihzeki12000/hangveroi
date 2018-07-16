@extends('layouts.app')
@section('content')
<div class="container-fluid mimin-wrapper">
	@include('admin.includes.left_menu')

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
				</div>
			</div>
		</div>
		<div class="col-md-12 top-20 padding-0">
			<div class="col-md-12 padding-0">
				<form class="cmxform" id="signupForm" method="post" action="{{ Request::url() }}" enctype="multipart/form-data">
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>{{ trans('news.basic_info') }}</h4>
							</div>
							<div class="panel-body">
								<input type="hidden" id="id" value={{ $id }} name="id" required>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-md-12 tabs-area">
									<ul id="tabs-product" class="nav nav-tabs nav-tabs-v3" role="tablist">
										<li role="presentation" class="active">
											<a href="#tabs-info" id="tabs-product-1" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('news.category_info') }}</a>
										</li>
									</ul>
									<div id="tabsDemo4Content" class="tab-content tab-content-v3">
										<div role="tabpanel" class="tab-pane fade active in" id="tabs-info" aria-labelledby="tabs-info">
											<div class="col-md-12">
												<div class="form-group form-animate-text" style="margin:40px 0 !important;">
													<input type="text" class="form-text" id="txt_name" value="{{ $name }}" name="name" required>
													<span class="bar"></span>
													<label>{{ trans("news.category") }}</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Tuỳ chọn</h4>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12 padding-0">
										<div class="box-type col-sm-12">
											<div class="form-group" style="margin-bottom:40px !important;">
												<label>{{ trans('news.status') }}</label>
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
<script>
	$(document).ready(function(){

		$("#signupForm").validate({
			errorElement: "em",
			errorPlacement: function(error, element) {
				$(element.parent("div").addClass("form-animate-error"));
				error.appendTo(element.parent("div"));
			},
			success: function(label) {
				$(label.parent("div").removeClass("form-animate-error"));
			},
			rules: {
				txt_name: "required",
			},
			messages: {
				txt_name: "Please enter name of category",
			}
		});
	});
</script>
@endsection