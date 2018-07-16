<div class="module-row">
	<div class="col-md-12">
		@foreach($productTypes as $pt_item)
		<?php $productItems = App\Models\Product::where('product_type', $pt_item['id'])->limit(12)->orderBy('updated_at', 'DESC')->get();?>
		@if(count($productItems)!=0)
		<h2 class="category-product">
			<span>{{ $pt_item['name'] }}</span>
		</h2>
		<div class="row">
			<div class="box-products">
				@foreach($productItems as $p_item)
				<div class="col-md-2 col-sm-4 col-xs-12">
					<a class="item" href="{{ URL::to('product/'.$p_item['slug'].'-'.$p_item['id']) }}">
						<div class="product-item">
							<img class="img-responsive img-thumbnail margin-bottom-5" style="height: 150px !important; width: 100% !important" src="{{ App\Models\Base::get_upload_url($p_item->getImage->filename) }}" alt="">
							<h3 class="product-name margin-top-0 margin-bottom-5">{{ $p_item['name'] }}</h3>
							<b class="price margin-top-0 margin-bottom-5">{{ product_price($p_item['price']) }}</b><!-- &nbsp;<i class="real-price">60.000 vnđ</i> --><br>
							<button data-id="{{ $p_item['id'] }}" class="btn btn-outline btn-danger pull-right addtocart addcart-absolute"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
		@endif
		@endforeach
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
			$.ajax({
				url: _base_url + "cart/addtocart",
				type: 'post',
				data: {
					id: product_id
				}
			})
			.done(function(html) {
				console.log(html);
				$('.cart-list').html(html);
				location.reload();
			})
			.fail(function() {
				console.log('error');
			});

			return false;

			// var cart = $('.shopping-cart');
			// var imgtodrag = $(this).closest('.product-item').find("img").eq(0);
			// if (imgtodrag) {
			// 	var imgclone = imgtodrag.clone()
			// 	.offset({
			// 		top: imgtodrag.offset().top,
			// 		left: imgtodrag.offset().left
			// 	})
			// 	.css({
			// 		'opacity': '0.5',
			// 		'position': 'absolute',
			// 		'height': '150px',
			// 		'width': '150px',
			// 		'z-index': '100'
			// 	})
			// 	.appendTo($('body'))
			// 	.animate({
			// 		'top': cart.offset().top + 10,
			// 		'left': cart.offset().left + 10,
			// 		'width': 75,
			// 		'height': 75
			// 	}, 1000, 'easeInOutExpo');

			// 	setTimeout(function () {
			// 		cart.effect("shake", {
			// 			times: 2
			// 		}, 200);
			// 	}, 1500);

			// 	imgclone.animate({
			// 		'width': 0,
			// 		'height': 0
			// 	}, function () {
			// 		$(this).detach()
			// 	});
			// }
		});
	});
</script>