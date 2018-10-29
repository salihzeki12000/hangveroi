@if(count($featureProducts) > 0)
<div class="module-row">
	<h2 class="is-feature">
		<span>Sản phẩm nổi bật</span>
	</h2>
	<div class="row">
		<div class="box-products">
			@foreach($featureProducts as $featureProduct)
			<div class="col-md-4">
				<a class="item hover-feature" href="{{ URL::to('product/'.$featureProduct['slug'].'-'.$featureProduct['id']) }}">
					<div class="product-item feature">
						<img class="feature-item" src="{{ asset('assets/img/is_feature.png') }}" alt="Sản phẩm {{ $featureProduct['name'] }} nổi bật">
						@if($featureProduct->image_thumb != 0)
						@if (!empty(App\Models\Gallery::find($featureProduct->image_thumb)))
						<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($featureProduct->getImage->filename) }}" alt="{{ $featureProduct['name'] }}">
						@endif
						@endif
						<h3 class="product-name margin-top-0 margin-bottom-5">{{ $featureProduct['name'] }}</h3>
						<b class="price margin-top-0 margin-bottom-5">{{ product_price($featureProduct['price']) }}</b>
						@if($featureProduct['real_price'] != 0)
						&nbsp;<i class="real-price">{{ product_price($featureProduct['real_price']) }}</i>
						@endif
						<div>
							<button id="addCart_{{ $featureProduct['id'] }}" data-id="{{ $featureProduct['id'] }}" data-name="{{ $featureProduct['name'] }}" data-price="{{ $featureProduct['price'] }}" data-category="{{ $featureProduct->getProductType->name }}" class="margin-top-10 margin-bottom-10 btn btn-outline btn-info btn-feature pull-right addtocart addcart-fullwidth <!--addcart-absolute-->"><i class="fa fa-cart-plus"></i> Cho vào giỏ hàng</button>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
	<hr>
</div>
@endif