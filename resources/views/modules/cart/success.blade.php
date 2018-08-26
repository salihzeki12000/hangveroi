@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li><a href="{{ URL::to('/account') }}">Tài khoản</a></li>
						<li class="active">Đặt hàng thành công</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="first-row margin-0">
			<div class="col-sm-12">
				<div class="alert alert-info margin-0">
					<h3>Đặt hàng thành công</h3>
					<p>Đơn hàng của bạn đã được đặt hàng thành công. Chúng tôi sẽ sớm liên hệ cho bạn để xác nhận đơn hàng. <br> Ohangveroi.com xin chân thành cảm ơn quý khách! <br>
						Trường hợp cần thiết, quý khách vui lòng liên hệ HOTLINE <b>0969 292 449</b>.
					</p>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr>
			<div class="col-md-12">
				<div class="module-row">
					<h2 class="category-product">
						<span>Sản phẩm bạn có thể mua thêm</span>
					</h2>
					<div class="row">
						<div class="box-products">
							@foreach($productItems as $productItem)
							<div class="col-md-2 col-sm-3 col-xs-">
								<a class="item" href="{{ URL::to('product/'.$productItem['slug'].'-'.$productItem['id']) }}">
									<div class="product-item">
										@if($productItem->image_thumb != 0)
										@if (!empty(App\Models\Gallery::find($productItem->image_thumb)))
										<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($productItem->getImage->filename) }}" alt="{{ $productItem['name'] }}">
										@endif
										@endif
										<h3 class="product-name margin-top-0 margin-bottom-5">{{ $productItem['name'] }}</h3>
										<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItem['price']) }}</b><!-- &nbsp;<i class="real-price">60.000 vnđ</i> --><br>
										<div>
											<button data-id="{{ $productItem['id'] }}" data-name="{{ $productItem['name'] }}" data-price="{{ $productItem['price'] }}" data-category="{{ $productItem->getProductType->name }}" class="btn btn-outline btn-danger pull-right addtocart addcart-fullwidth <!--addcart-absolute-->">Mua Ngay<!--<i class="fa fa-cart-plus" aria-hidden="true"></i>--></button>
										</div>
									</div>
								</a>
							</div>
							@endforeach
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="{{ URL::to('/') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Tiếp tục mua hàng</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
@stop