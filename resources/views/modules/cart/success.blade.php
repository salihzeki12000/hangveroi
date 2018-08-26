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
@stop