@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-8">
				<div class="main_slide">
					<ul class="bxslider">
						@foreach ($main_sliders as $main_slider)
						@if($main_slider->image != 0)
						@if (!empty(App\Models\Gallery::find($main_slider->image)))
						<li>
							<a href="{{ $main_slider->url }}" title="{{ $main_slider->alt }}">
								<img src="{{ App\Models\Base::get_upload_url($main_slider->getImage->filename) }}" alt="{{ $main_slider->alt }}">
							</a>
						</li>
						@endif
						@endif
						@endforeach
					</ul>
					<script>
						$(document).ready(function(){
							$('.bxslider').bxSlider({
								mode: 'fade',
								captions: true,
								pager: false,
								randomStart: true,
								auto: true,
								speed: 500,
							});
						});
					</script>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					@foreach ($right_indexs as $right_index)
					@if($right_index->image != 0)
					@if (!empty(App\Models\Gallery::find($right_index->image)))
					<div class="col-md-12 margin-bottom-12">
						<a href="{{ $right_index->url }}" title="{{ $right_index->alt }}">
							<img class="img-responsive" src="{{ App\Models\Base::get_upload_url($right_index->getImage->filename) }}" alt="{{ $right_index->alt }}">
						</a>
					</div>
					@endif
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="second-row">
		<div class="box-bg-xam">
			<div class="col-md-6">
				<div class="box-promotion">
					<div class="col-md-7">
						<h2>Đồ gia dụng tiện ích</h2>
						<p>
							Cung cấp sỉ và lẻ các sản phẩm liên quan đến gia dụng, nội thất. Hàng chính hãng 100%, giao hàng miễn phí...
						</p>
						<a href="#">Xem tiếp</a>
					</div>
					<div class="col-md-5">
						<img class="img-responsive" src="{{ asset('assets/img/temp/nuoc24h.jpg') }}" alt="">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box-promotion">
					<div class="col-md-7">
						<h2>Khuyến mãi - Ưu đãi</h2>
						<p>
							Các chương trình khuyến mãi được áp dụng hàng tháng với từng ngành hàng riêng biệt. Giảm giá ưu đãi lên đến 50%.
						</p>
						<a href="#">Xem tiếp</a>
					</div>
					<div class="col-md-5">
						<img class="img-responsive" src="{{ asset('assets/img/temp/banner_237x146.png') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12">
	<?php echo Modules\Product\Http\Controllers\ProductController::getFeatureProductTop(); ?>
</div>
<div class="col-md-12">
	<a href="{{ URL::to('product/type/do-dung-gia-dinh-5') }}" title="Đồ gia dụng giá rẻ tại Ohangveroi.com">
		<img class="img-responsive" src="{{ asset('assets/img/muahanggiare.png') }}" alt="Mua hàng giá rẻ tại tp hcm">
	</a>
	<hr>
</div>
<div class="col-md-12">
	<?php echo Modules\Product\Http\Controllers\ProductController::listProductByProductType(13); ?>
	<?php echo Modules\Product\Http\Controllers\ProductController::listProductByProductType(10); ?>
	<?php echo Modules\Product\Http\Controllers\ProductController::listProductByProductType(5); ?>
	<script>
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name="_token"]').attr('content')
				}
			});
			$('.addtocart').on('click', function () {
				var product_id = $(this).data('id');
				var product_name = $(this).data('name');
				var product_category = $(this).data('category');
				var product_price = $(this).data('price'); 

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
							fbq('track', 'AddToCart', {
								content_name: product_name, 
								content_category: product_category,
								content_ids: [product_id],
								content_type: 'product',
								value: product_price,
								currency: 'VND' 
							});
						} else {
							$.notify({
								message: "Thêm giỏ sản vào giỏ hàng không thành công!"
							},{
								type: 'danger'
							});
						}
					})
				})
				return false;
			});
		});
	</script>
</div>
<div class="col-md-12">
	<div class="third-row">
		<div class="row">
			<div class="box-service">
				<div class="col-md-3">
					<div class="box1">
						<i class="fa fa-truck" aria-hidden="true"></i>
						<h3>Vận chuyển</h3>
						<p>Giao hàng 24/24 với tất cả đơn hàng chỉ từ 100.000 VNĐ.</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box2">
						<i class="fa fa-cc-visa" aria-hidden="true"></i>
						<h3>Thanh toán</h3>
						<p>Chấp nhận thanh toán online, offline cho tất cả đơn hàng.</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box3">
						<i class="fa fa-battery-full" aria-hidden="true"></i>
						<h3>Phục vụ</h3>
						<p>Khuyến mãi, hậu mãi hàng tháng cho tri ân khách hàng.</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box4">
						<i class="fa fa-users" aria-hidden="true"></i>
						<h3>Hổ trợ</h3>
						<p>Tư vấn online, trực tiếp bằng điện thoại, skype, viber...</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
