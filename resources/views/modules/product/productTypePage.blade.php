@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						{!! App\Models\Base::buildBreadcrumb(App\Models\Base::PRODUCT_TYPE_BREADCRUMB, $productType->id) !!}
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-3 left-position">
				<div class="wrapmenu">
					<h2>DANH MỤC SẢN PHẨM</h2>
					<ul class="parent">
						@foreach ($productTypes as $item)
						<li>
							<a href="{{ URL::to('product/type/' . $item->slug . '-' . $item->id) }}">
								{{ $item->name }}
							</a>
						</li>
						<?php
						$typeChilds = App\Models\ProductType::where('parent', $item->id)->get();
						?>
						@if (!empty ($typeChilds))
						<ul class="child">
							@foreach ($typeChilds as $itemChild)
							<li>
								<a href="{{ URL::to('product/type/' . $itemChild->slug . '-' . $itemChild->id) }}">
									{{ $itemChild->name }}
								</a>
							</li>
							@endforeach
						</ul>
						@endif
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-9 right-position">
				<div class="wrapListProduct">
					<?php 

					?>
					<?php echo Modules\Product\Http\Controllers\ProductController::listProduct($productType->id, [3, 6, 12], 24, 'list'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
@stop