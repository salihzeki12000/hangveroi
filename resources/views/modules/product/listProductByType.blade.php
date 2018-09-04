<?php 
if (!$error) {
	$productItems = App\Models\Product::whereIn('product_type', $arrayTypes)
	->orderBy('created_at', 'DESC')
	->limit($limitProduct)->get();
	if (empty($productItems)) {
		?>
		<div class="module-row">
			<h2 class="category-product">
				<span>{{ $productTypeName }}</span>
			</h2>
			<div class="row">
				<div class="box-products">
					<p style="text-align: center; margin: 10px 0;">Không có sản phẩm trong mục này</p>
				</div>
			</div>
		</div>
		<?php 
	} else {
		?>
		<div class="module-row">
			<h2 class="category-product">
				<span>{{ $productTypeName }}</span>
			</h2>
			<div class="row">
				<div class="box-products">
					<div class="col-md-4">
						<a class="item" href="{{ URL::to('product/'.$productItems[0]['slug'].'-'.$productItems[0]['id']) }}">
							<div class="product-item feature">
								@if($productItems[0]->hasPromotion())
								<img class="hot" src="{{ asset('assets/img/discounts.png') }}" alt="Sản phẩm {{ $productItems[0]['name'] }} giảm giá {{ $productItems[0]->getPromotion->discount }} phần trăm">
								<span class="percent-discount">{{ $productItems[0]->getPromotion->discount }}%</span>
								@else
								<img class="hot" src="{{ asset('assets/img/hot-item.png') }}" alt="Sản phẩm {{ $productItems[0]['name'] }} nổi bật">
								@endif
								@if($productItems[0]->image_thumb != 0)
								@if (!empty(App\Models\Gallery::find($productItems[0]->image_thumb)))
								<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($productItems[0]->getImage->filename) }}" alt="{{ $productItems[0]['name'] }}">
								@endif
								@endif
								<h3 class="product-name margin-top-0 margin-bottom-5">{{ $productItems[0]['name'] }}</h3>
								@if($productItems[0]->hasPromotion())
								<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItems[0]->getPromotion->money_has_discount) }}</b>
								@else
								<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItems[0]['price']) }}</b>
								@endif
								<div class="boxcount-social-top">
									<div class="fb-like" data-href="{{ URL::to('product/'.$productItems[0]['slug'].'-'.$productItems[0]['id']) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
								</div>
								@if($productItems[0]->hasPromotion())
								&nbsp;<i class="real-price">{{ product_price($productItems[0]['price']) }}</i><br>
								@endif
								<div>
									<button data-id="{{ $productItems[0]['id'] }}" data-name="{{ $productItems[0]['name'] }}" data-price="{{ $productItems[0]['price'] }}" data-category="{{ $productItems[0]->getProductType->name }}" class="margin-top-10 margin-bottom-10 btn btn-outline btn-default pull-right addtocart addcart-fullwidth <!--addcart-absolute-->"><i class="fa fa-cart-plus"></i> Mua Ngay</button>
								</div>
								<div class="clearfix"></div>
								<img class="img-responsive" src="{{ asset('assets/img/freeship.png') }}" alt="">
							</div>
						</a>
					</div>
					<div class="col-md-8">
						<div class="row">
							@for($i = 1; $i < count($productItems); $i++)
							<div class="col-md-3 col-sm-4 col-xs-6">
								<a class="item" href="{{ URL::to('product/'.$productItems[$i]['slug'].'-'.$productItems[$i]['id']) }}">
									<div class="product-item">
										@if($productItems[$i]->image_thumb != 0)
										@if (!empty(App\Models\Gallery::find($productItems[$i]->image_thumb)))
										<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($productItems[$i]->getImage->filename) }}" alt="{{ $productItems[$i]['name'] }}">
										@endif
										@endif
										<h3 class="product-name margin-top-0 margin-bottom-5">{{ $productItems[$i]['name'] }}</h3>
										@if($productItems[$i]->hasPromotion())
										<b class="price margin-top-0 margin-bottom-5 font-size-18">{{ product_price($productItems[$i]->getPromotion->money_has_discount) }}</b>
										&nbsp;<i class="real-price">{{ product_price($productItems[$i]['price']) }}</i><br>
										@else
										<b class="price margin-top-0 margin-bottom-5 font-size-18">{{ product_price($productItems[$i]['price']) }}</b>
										@endif
										<!-- <div class="boxcount-social-top">
											<div class="fb-like" data-href="{{ URL::to('product/'.$productItems[$i]['slug'].'-'.$productItems[$i]['id']) }}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
										</div> -->
										<div class="margin-top-10">
											<button data-id="{{ $productItems[$i]['id'] }}" data-name="{{ $productItems[$i]['name'] }}" data-price="{{ $productItems[$i]['price'] }}" data-category="{{ $productItems[$i]->getProductType->name }}" class="btn btn-outline btn-default pull-right addtocart addcart-fullwidth <!--addcart-absolute-->"><i class="fa fa-cart-plus"></i> Mua Ngay</button>
										</div>
									</div>
								</a>
							</div>
							@endfor
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>