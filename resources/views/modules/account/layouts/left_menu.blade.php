<ul class="parent">
	<li class="{{ REQUEST::url() == URL::to('/account/edit') ? 'active' : '' }}">
		<a href="{{ URL::to('/account/edit') }}">
			Thông tin tài khoản
		</a>
	</li>
	<li class="{{ REQUEST::url() == URL::to('/account/order/history') ? 'active' : '' }}">
		<a href="{{ URL::to('/account/order/history') }}">
			Quản lý đơn hàng
		</a>
	</li>
	<li class="{{ REQUEST::url() == URL::to('/account/order/review') ? 'active' : '' }}">
		<a href="{{ URL::to('/account/order/review') }}">
			Nhận xét sản phẩm đã mua
		</a>
	</li>
	<li class="{{ REQUEST::url() == URL::to('/account/my-review') ? 'active' : '' }}">
		<a href="{{ URL::to('/account/my-review') }}">
			Nhận xét của tôi
		</a>
	</li>
</ul>