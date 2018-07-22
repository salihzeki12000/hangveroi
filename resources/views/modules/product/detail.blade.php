@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						{!! App\Models\Base::buildBreadcrumb(App\Models\Base::PRODUCT_BREADCRUMB, $articleItem['id']) !!}
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			{!! Html::style('plugins/fancyapps/jquery.fancybox.css') !!}
			{!! Html::script('plugins/fancyapps/jquery.fancybox.pack.js') !!}
			{!! Html::script('plugins/elevatezoom/jquery.elevateZoom3.min.js') !!}
			<div class="col-md-12">
				<div class="box-content">
					<div class="row">
						<div class="col-md-5">
							<div class="bigImage">
								@if(count(App\Models\Gallery::find($articleItem->image_thumb)) != 0)
								<img id="imgF" style="width: 100%" src="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}" data-zoom-image="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}"/>
								@endif
							</div>
							<div id="listImage">
								@if(count(App\Models\Gallery::find($articleItem->image_thumb)) != 0)
								<a href="#" data-image="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}" data-zoom-image="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}">
									<img id="imgF" style="width: 20%" src="{{ App\Models\Base::get_upload_url($articleItem->getImage->filename) }}"/>
								</a>
								@endif
								@if(count($productImages) != 0)
								@foreach ($productImages as $img_item)
								<a href="#" data-image="{{ App\Models\Base::get_upload_url($img_item->getImage->filename) }}" data-zoom-image="{{ App\Models\Base::get_upload_url($img_item->getImage->filename) }}">
									<img id="imgF" style="width: 20%" src="{{ App\Models\Base::get_upload_url($img_item->getImage->filename) }}" />
								</a>
								@endforeach
								<script>
									$("#imgF").elevateZoom({
										gallery:'listImage', 
										cursor: 'pointer', 
										galleryActiveClass: 'active', 
										imageCrossfade: false, 
										loadingIcon: '{{ asset("assets/img/loader.gif") }}',
										responsive: true,
										scrollZoom: true,
										easing: true,
										lensSize: 10,
										lensFadeIn: 200,
										lensFadeOut: 200,
										lenszoom: true
									}); 
									$("#imgF").bind("click", function(e) {  
										var ez =   $('#imgF').data('elevateZoom');	
										$.fancybox(ez.getGalleryList());
										return false;
									});
								</script>
								<style>
									#imgF img{border:2px solid white;}
									.active img{border:2px solid #333 !important;}
								</style>
								@endif
							</div>
						</div>
						<div class="col-md-7">
							<div class="product-name">{{ $articleItem['name'] }}</div>
							<b class="price">{{ product_price($articleItem['price']) }}</b><!-- &nbsp;<i class="real-price">60.000 vnđ</i> --><br>
							<div class="boxcount-social">
								<div class="fb-like" data-href="{{ Request::url() }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div> <br>
								<div class="g-plusone" data-size="medium" data-annotation="inline"></div>
							</div>
							<div class="status"><b>Tình trạng:</b> Còn hàng</div>
							<div class="status">
								<b>Đánh giá:</b> <br/>
								@for($i = 0; $i < $productReview; $i++)
								<i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
								@endfor
								<i>({{ count($productReviews) }} đánh giá)</i> / <a href="#" data-toggle="modal" data-target="#createreview">Viết đánh giá</a>
								<div class="modal fade" id="createreview" tabindex="-1" role="dialog" aria-labelledby="Viết đánh giá">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="Viết đánh giá">Viết đánh giá</h4>
											</div>
											<div class="modal-body">
												<input type="hidden" class="form-control" id="product_id" value="{{ $articleItem['id'] }}" name="product_id">
												<div class="form-group">
													<label>Tên của bạn</label>
													<input type="text" class="form-control" id="yourname" value="" name="yourname">
												</div>
												<div class="form-group">
													<label>Email của bạn</label>
													<input type="email" class="form-control" id="youremail" value="" name="youremail">
												</div>
												<div class="form-group">
													<label>Đánh giá của bạn</label>
													<textarea class="form-control" name="yourreview" id="yourreview" cols="30" rows="10"></textarea>
												</div>
												<div class="form-group">
													<div class="checkbox">
														<label>
															<input checked name="getreview" id="getreview" type="radio" value=5> <i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input name="getreview" id="getreview" type="radio" value=4> <i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input name="getreview" id="getreview" type="radio" value=3> <i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input name="getreview" id="getreview" type="radio" value=2> <i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i><i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
														</label>
													</div>
													<div class="checkbox">
														<label>
															<input name="getreview" id="getreview" type="radio" value=1> <i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
														</label>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
												<button type="button" class="btn sendreview btn-danger">Gửi đi</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="status">
								<a data-id="{{ $articleItem['id'] }}" class="btn btn-danger addtocart" href="#">Mua ngay</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="third-row">
			<div class="col-md-12">
				<div class="box-detail-review">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Mô tả</a></li>
						<li role="presentation"><a href="#reviewbox" aria-controls="reviewbox" role="tab" data-toggle="tab">Đánh giá</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="description">
							<b>Giới thiệu ngắn</b><br>
							<?php echo $articleItem['specifications']; ?>
							<br>
							---------------------------------------------------
							<br><br>
							<b>Mô tả</b><br>
							<?php echo $articleItem['descriptions']; ?>
						</div>
						<div role="tabpanel" class="tab-pane" id="reviewbox">
							@if(!is_null($productReviews))
							@foreach( $productReviews as $pv_item )
							<div class="each-review">
								<div class="media">
									<div class="media-left">
										<span class="showlike_{{ $pv_item['id'] }}">
											@if($pv_item['like'] != 0)
											{{ $pv_item['like'] }} likes
											@else
											{{ $pv_item['like'] }} like
											@endif
										</span>
									</div>
									<div class="media-body">
										<h4 class="media-heading">{{ $pv_item['name'] }}</h4>
										@for($i = 0; $i < $pv_item['review']; $i++)
										<i style="color: #cc0000" class="fa fa-star" aria-hidden="true"></i>
										@endfor
										<p>
											{{ $pv_item['content'] }}
										</p>
										<a data-id="{{ $pv_item['id'] }}" class="like_{{ $pv_item['id'] }} likepro" href="#">Like</a>
									</div>
								</div>
							</div>
							<script>
								$('.like_{{ $pv_item['id'] }}').click(function(){ 
									var review_id = $(this).data('id');
									$.ajax({
										url: "{{ URL::to(Request::segment(1).'/plus-like') }}",
										type: 'post',
										data: {
											id: review_id,
											_token: "{{ csrf_token() }}"
										}
									})
									.done(function(html) {
										$('.showlike_{{ $pv_item['id'] }}').html(html);
									})
									.fail(function() {
										console.log('Error');
									});	
									return false;
								});
							</script>
							@endforeach 
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="four-row">
			<div class="col-md-12">
				<div class="box-tags">
					<b>Tags:</b> <a href="#">cho</a>, <a href="#">meo</a>, <a href="#">ga</a>
				</div>
			</div>
		</div>
	</div> --}}
</div>

<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			}
		});
		$('.addtocart').on('click', function () {
			var product_id = $(this).data('id');
			$.ajax({
				url: _base_url + "cart/addtocart",
				type: 'post',
				data: {
					id: product_id
				},
				success:(function(result) {
					if (result.error == false) {
						$.notify({
							message: "Thêm sản phẩm vào giỏ hàng thành công!"
						},{
							type: 'success'
						});
						var cart = result.cart;
						var html = '';
						$('.quantity').html(result.totalQty);
						for(var k in cart) {
							html += '<li><a href="' + _base_url + 'product/' + cart[k].options.slug + '-' + cart[k].id +'"><div class="name">' + cart[k].name + '</div><div><img src="' + cart[k].options.image + '" alt="' + cart[k].name + '"><div class="price">Giá: ' + cart[k].price + ' <br>Số lượng: ' + cart[k].qty + '</div></div></a></li>';
						}
						html += '<li class="divider"></li><li><a style="color: #cc0000" href="' + _base_url + 'cart/checkout/list">Xem giỏ hàng <i class="fa fa-check fa-2x" aria-hidden="true"></i></a></li>';
						$('.sub-cart').html(html);
					} else {
						$.notify({
							message: "Thêm giỏ sản vào giỏ hàng không thành công!"
						},{
							type: 'danger'
						});
					}
				})
			});
			return false;
		});
		$(".sendreview").click(function (){ 
			var product_id = $("#product_id").val();
			var name = $("#yourname").val();
			var email = $("#youremail").val();
			var content = $("#yourreview").val();
			var review = $("#getreview").val();

			if (name == null || name == '') {
				alert("Vui lòng nhập tên của bạn.");
				$("#yourname").focus();
				return false;
			}
			if (email == null || email == '') {
				alert("Vui lòng nhập email của bạn.");
				$("#youremail").focus();
				return false;
			}
			if (content == null || content == '') {
				alert("Hãy cho chúng tôi biết đánh giá của bạn.");
				$("#yourreview").focus();
				return false;
			}

			$.ajax({
				url: "{{ URL::to(Request::segment(1).'/create-review') }}",
				type: 'post',
				data: {
					id: product_id,
					name: name,
					email: email,
					content: content,
					review: review,
					_token: "{{ csrf_token() }}"
				}
			})
			.done(function(html) {
				if (html == "ok") {
					BootstrapDialog.show({
						type: BootstrapDialog.TYPE_SUCCESS,
						title: 'Success',
						message: 'Bài viết của bạn được tiếp nhận, chúng tôi sẽ duyệt trong vòng 24h. Xin cảm ơn!'
					});
					$('#createreview').modal('hide');
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
	});
</script>
@stop