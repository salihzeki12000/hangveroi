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
								<h4>{{ trans('product.basic_info') }}</h4>
							</div>
							<div class="panel-body">
								<input type="hidden" id="id" value={{ $id }} name="id" required>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-md-12 tabs-area">
									<ul id="tabs-product" class="nav nav-tabs nav-tabs-v3" role="tablist">
										<li role="presentation" class="active">
											<a href="#tabs-info" id="tabs-product-1" role="tab" data-toggle="tab" aria-expanded="true">{{ trans('product.product_info') }}</a>
										</li>
										<li role="presentation" class="">
											<a href="#tabs-image" role="tab" id="tabs-product-2" data-toggle="tab" aria-expanded="false">{{ trans('product.image_lib') }}</a>
										</li>
									</ul>
									<div id="tabsDemo4Content" class="tab-content tab-content-v3">
										<div role="tabpanel" class="tab-pane fade active in" id="tabs-info" aria-labelledby="tabs-info">
											<div class="col-md-12">
												<div class="form-group form-animate-text" style="margin:40px 0 !important;">
													<input type="text" class="form-text" id="txt_name" value="{{ $name }}" name="name" required>
													<span class="bar"></span>
													<label>{{ trans("product.name") }}</label>
												</div>

												<div class="form-group" style="margin-bottom:40px !important;">
													<label style="font-size: 18px; padding: 5px;">{{ trans("product.price") }}</label>
													<div class="input-group">
														<span class="input-group-addon">VND</span>
														<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" value="{{ money_format('%!2n',floatval($price)) }}" required>
													</div>
												</div>
												<div class="form-group form-animate-text" style="margin-bottom:40px !important;">
													<input type="text" class="form-text" id="txt_units" name="units_on_order" value={{ $units_on_order }} required>
													<span class="bar"></span>
													<label>{{ trans("product.units") }}</label>
												</div>
												<div class="form-group" style="margin-bottom:40px !important;">
													<label style="font-size: 18px; padding: 5px;">{{ trans("product.specifications") }}</label>
													<textarea class="editor1" name="specifications"><?php echo ($specifications); ?></textarea>
												</div>
												<div class="form-group" style="margin-bottom:40px !important;">
													<label style="font-size: 18px; padding: 5px;">{{ trans("product.descriptions") }}</label>
													<textarea class="editor2" name="descriptions"><?php echo ($descriptions); ?></textarea>
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="tabs-image" aria-labelledby="tabs-image">
											<div class="panel">
												<div class="panel-body">
													<div class="gc_photo" id="gc_photo">
														<table cellspacing="0" cellpadding="0">
															@if($productImageItems)
															@foreach($productImageItems as $img)
															<tr id="row_{{ $img->id }}">
																<td style="width:81px;padding-right:10px;">
																	<img width="150" class="gc_thumbnail" src="{{ App\Models\Base::get_upload_url($img->getImage->filename) }}"/>
																</td>
																<td valign="top" width="430" style="vertical-align:top">      
																	<table width="100%">
																		<tr>
																			<td colspan="2">
																				<a  onclick="return remove_product_image({{ $img->id }});" rel="" class="btn" style="float:right; font-size:9px; cursor:pointer">Remove</a>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
															@endforeach
															@endif
														</table>
													</div>
													<div id="queue"></div>
													<input id="file_upload" name="file_upload" type="file" multiple="true">
													<br clear="all" />
													<div id="gc_photos">
													</div>
													<script type="text/javascript">
														<?php $timestamp = time();?>
														$(function() {
															$('#file_upload').uploadify({
																'formData'     : {
																	'timestamp' : '<?php echo $timestamp;?>',
																	'_token'     : '{{ csrf_token() }}',
																	'id'	: '{{ Request::segment(4) }}',
																},
																'swf'      : '{{ URL::to("/plugins/uploadify/uploadify.swf") }}',
																'uploader' : '{{ URL::to(Request::segment(1)."/product/image/upload") }}',
																'queueSizeLimit': 10,
																'onQueueFull': function(event, queueSizeLimit) {
																	alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
																	return false;
																},
																'onUploadComplete' : function(file, data, response) {
																	add_product_image(file.name, file.index);
																}

															});
														});
													</script>
													<script type="text/javascript">
														function add_product_image(data, index)
														{
															$.ajax({
																url: _base_url + "admin/product/image/get",
																data: {
																	'id': '{{ Request::segment(4) }}',
																	'_token': '{{ csrf_token() }}',
																},
																method: 'POST',
																dataType: "html",
																success:function(html){
																	$('#gc_photo').html(html);
																}
															}); 
														}

														function remove_product_image(id)
														{
															if(confirm('Bạn có muốn xóa không ?'))
															{
																$.ajax({
																	url: _base_url + "admin/product/image/delete",
																	data: {
																		'id': id,
																		'_token': '{{ csrf_token() }}',
																	},
																	method: 'POST',
																	dataType: "html",
																	success:function(html){
																		if (html == "true") {
																			BootstrapDialog.show({
																				type: BootstrapDialog.TYPE_SUCCESS,
																				title: 'Success',
																				message: 'The image has been deleted!'
																			});
																			$("#row_" + id).remove();
																		} else {
																			BootstrapDialog.show({
																				type: BootstrapDialog.TYPE_WARNING,
																				title: 'Error',
																				message: 'The image does not exist.'
																			});
																		}
																	}
																}); 
															}
														}
													</script>
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
										<div class="box-type col-sm-12 padding-0">
											@include('admin.block.product.list_product_type')
										</div>
										<div class="box-type col-sm-12 padding-0">
											@include('admin.block.product.list_product_manufacturer')
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
										<div class="box-type col-sm-12">
											<div class="form-group" style="margin-bottom:40px !important;">
												<label>Thumbnail</label>
												<img style="margin-bottom: 10px" width="100%" id="output" src="{{ $image_thumb }}" />
												<input type="file" name="image_thumb" onchange="loadFile(event)">
												<script>
													var loadFile = function(event) {
														var output = document.getElementById('output');
														output.src = URL.createObjectURL(event.target.files[0]);
													};
												</script>
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
<script>
	$(document).ready(function(){

		$('.editor1').froalaEditor({
			height: 200,
			toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', '-', 'insertLink', 'insertTable', 'undo', 'redo', 'clearFormatting', 'html']
		});
		$('.editor2').froalaEditor({
			height: 400,
			imageDefaultAlign: 'left',

			// Set a preloader.
			imageManagerPreloader: "{{ asset('assets/img/loader.gif') }}",
			// Set page size.
			imageManagerPageSize: 5,

			// Set a scroll offset (value in pixels).
			imageManagerScrollOffset: 5,

			// Set the load images request URL.
			imageManagerLoadURL: "{{ URL::to(Request::segment(1).'/image') }}",

			// Set the load images request type.
			imageManagerLoadMethod: "GET",

			// Additional load params.
			imageManagerLoadParams: {
				'user_id': {{ Auth::user()->id }},
				'tag': 'products.image',
			},


			// Set the delete image request URL.
			imageManagerDeleteURL: "{{ URL::to(Request::segment(1).'/image/delete') }}",

			// Set the delete image request type.
			imageManagerDeleteMethod: "POST",

			// Additional delete params.
			imageManagerDeleteParams: { 
				'id': $(this).data("id"),
				'_token': '{{ csrf_token() }}', 
			},


			// Set the image upload parameter.
			imageUploadParam: 'file_name',
			// Set the image upload URL.
			imageUploadURL: "{{ URL::to(Request::segment(1).'/image/upload') }}",
			// Additional upload params.
			imageUploadParams: {
				'tag': 'news',
				'_token': '{{ csrf_token() }}', 
			},
			// Set request type.
			imageUploadMethod: 'POST',
			// Set max image size to 5MB.
			imageMaxSize: 5 * 1024 * 1024,
			// Allow to upload PNG and JPG.
			imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif', 'bmp']
			});

		$(".nav-tabs a").click(function (e) {
			e.preventDefault();  
			$(this).tab('show');
		});

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
				validate_firstname: "required",
				validate_lastname: "required",
				validate_username: {
					required: true,
					minlength: 2
				},
				validate_password: {
					required: true,
					minlength: 5
				},
				validate_confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#validate_password"
				},
				validate_email: {
					required: true,
					email: true
				},
				validate_agree: "required"
			},
			messages: {
				validate_firstname: "Please enter your firstname",
				validate_lastname: "Please enter your lastname",
				validate_username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				validate_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				validate_confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				validate_email: "Please enter a valid email address",
				validate_agree: "Please accept our policy"
			}
		});
	});
</script>
@endsection