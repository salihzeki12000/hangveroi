<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle shopping-cart">
			@if(Cart::count() != 0)
			<span class="quantity">{{ Cart::count() }}</span>
			@endif
			<i style="color: #fff" class="fa fa fa-shopping-cart" aria-hidden="true"></i>
			Giỏ hàng
		</a>
		@if(Cart::count() != 0)
		<ul class="dropdown-menu dropdownhover-bottom sub-cart" role="menu">
			@foreach(Cart::content() as $c_item)
			<li>
				<a href="{{ URL::to('product/'.$c_item->options->slug.'-'.$c_item->id) }}">
					<div class="name">
						{{ $c_item->name }}
					</div>
					<div>
						<img src="{{ $c_item->options->image }}" alt="{{ $c_item->name }}">
						<div class="price">
							Giá: {{ product_price($c_item->price) }} <br>
							Số lượng: {{ $c_item->qty }}
						</div>
					</div>
				</a>
			</li>
			@endforeach
			<li class="divider"></li>
			<li>
				<a style="color: #cc0000" href="{{ URL::to('cart/checkout') }}">Thanh toán <i class="fa fa-check fa-2x" aria-hidden="true"></i></a>
			</li>
		</ul>
		@endif
	</li>
</ul>