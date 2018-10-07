@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li>{{ $productTypeName }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-12 right-position">
				<div class="wrapListProduct">
					<div class="module-row">
						<h2 class="category-product">
							<span>{{ $productTypeName }}</span>
						</h2>
						<div class="row">
							<div class="box-products">
								@foreach($productItems as $productItem)
								<div class="col-md-{{ $colNum[0] }} col-sm-{{ $colNum[1] }} col-xs-{{ $colNum[2] }}">
									<a class="item" href="{{ URL::to('product/'.$productItem['slug'].'-'.$productItem['id']) }}">
										<div class="product-item">
											@if($productItem->image_thumb != 0)
											@if (!empty(App\Models\Gallery::find($productItem->image_thumb)))
											<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($productItem->getImage->filename) }}" alt="{{ $productItem['name'] }}">
											@endif
											@endif
											<h3 class="product-name margin-top-0 margin-bottom-5">{{ $productItem['name'] }}</h3>
											@if($productItem->hasPromotion())
											<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItem->getPromotion->money_has_discount) }}</b>&nbsp;<i class="real-price">{{ product_price($productItem['price']) }}</i>
											@else
											<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItem['price']) }}</b>
											@endif
											<div>
												<button data-id="{{ $productItem['id'] }}" data-name="{{ $productItem['name'] }}" data-price="{{ $productItem['price'] }}" data-category="{{ $productItem->getProductType->name }}" class="btn btn-outline btn-default pull-right addtocart addcart-fullwidth <!--addcart-absolute-->"><i class="fa fa-cart-plus"></i> Mua Ngay</button>
											</div>
										</div>
									</a>
								</div>
								@endforeach
							</div>
							<div class="col-md-12">
								<div class="pull-right">
									{{ $productItems->links() }}
								</div>
							</div>
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
							content_ids: product_id,
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