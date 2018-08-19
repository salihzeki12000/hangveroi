@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li><a href="{{ URL::to('/search?' . Request::getQueryString()) }}">Tìm kiếm</a></li>
						<li>Kết quả cho: "{{ Request::get('keyword') }}"</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-12">
				<div class="module-row">
					@if (isset($productItems) && count($productItems) > 0)
					<h2 class="category-product">
						<span>Có {{ count($productItems) }} kết quả cho: {{ Request::get('keyword') }}</span>
					</h2>
					<div class="row">
						<div class="box-products">
							@foreach($productItems as $productItem)
							<div class="col-md-3 col-sm-4 col-xs-6">
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
					@else
					<h2 class="category-product">
						<span>Có 0 kết quả cho: {{ Request::get('keyword') }}</span>
					</h2>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<a href="{{ URL::to('product/type/do-dung-gia-dinh-5') }}" title="Đồ gia dụng giá rẻ tại Ohangveroi.com">
				<img class="img-responsive" src="{{ asset('assets/img/muahanggiare.png') }}" alt="Mua hàng giá rẻ tại tp hcm">
			</a>
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
@endsection