<?php 
$productItems = App\Models\Product::whereIn('product_type', $arrayTypes)
->orderBy('updated_at', 'DESC')
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
				@foreach($productItems as $productItem)
				<div class="col-md-2 col-sm-4 col-xs-12">
					<a class="item" href="{{ URL::to('product/'.$productItem['slug'].'-'.$productItem['id']) }}">
						<div class="product-item">
							<img class="img-responsive img-thumbnail margin-bottom-5" style="height: 150px !important; width: 100% !important" src="{{ App\Models\Base::get_upload_url($productItem->getImage->filename) }}" alt="">
							<h3 class="product-name margin-top-0 margin-bottom-5">{{ $productItem['name'] }}</h3>
							<b class="price margin-top-0 margin-bottom-5">{{ product_price($productItem['price']) }}</b><!-- &nbsp;<i class="real-price">60.000 vnđ</i> --><br>
							<div>
								<button data-id="{{ $productItem['id'] }}" class="btn btn-outline btn-danger pull-right addtocart addcart-fullwidth <!--addcart-absolute-->">Mua Ngay<!--<i class="fa fa-cart-plus" aria-hidden="true"></i>--></button>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<?php
}
?>