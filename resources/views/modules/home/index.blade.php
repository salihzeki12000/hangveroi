@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<div class="col-md-8">
				<div class="main_slide">
					<ul class="bxslider">
						<li><img src="{{ asset('assets/img/temp/1.png') }}" alt=""></li>
						<li><img src="{{ asset('assets/img/temp/2.jpg') }}" alt=""></li>
						<li><img src="{{ asset('assets/img/temp/3.jpg') }}" alt=""></li>
						<li><img src="{{ asset('assets/img/temp/4.png') }}" alt=""></li>
						<li><img src="{{ asset('assets/img/temp/5.png') }}" alt=""></li>
					</ul>
					<script>
						$(document).ready(function(){
							$('.bxslider').bxSlider({
								mode: 'fade',
								captions: true,
								pager: false,
								randomStart: true,
								auto: true,
								speed: 500,
							});
						});
					</script>
				</div>
			</div>
			<div class="col-md-4">
				<?php echo Modules\Video\Http\Controllers\VideoController::topVideo(); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-12">
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
	<div class="row">
		<?php echo Modules\Product\Http\Controllers\ProductController::listProduct(); ?>
	</div>
	<div class="row">
		<div class="five-row">
			<div class="col-md-12">
				<div class="box-border-xam">
					<div id="owl-demo">
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
						<div class="item"><img class="img-thumbnail" src="{{ asset('assets/img/temp/logo-cus.jpg') }}"></div>
					</div>
					<style>
						#owl-demo .item{
							margin: 5px;
						}
						#owl-demo .item img{
							display: block;
							width: 100%;
							height: auto;
						}
					</style>
					<script>
						$(document).ready(function() {
							$("#owl-demo").owlCarousel({
								autoPlay: 3000,
								items : 5,
								pagination: false
							});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="five-row">
			<div class="col-md-12">
				<a href="#" class="banner-footer">
					<img class="img-responsive" src="{{ asset('assets/img/temp/banner_footer.png') }}" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="third-row">
			<div class="col-md-12">
				<div class="row">
					<div class="box-service">
						<div class="col-md-3">
							<div class="box1">
								<i class="fa fa-truck" aria-hidden="true"></i>
								<h3>Vận chuyển</h3>
								<p>Giao hàng 24/24 với tất cả đơn hàng chỉ từ 100.000 VNĐ.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box2">
								<i class="fa fa-cc-visa" aria-hidden="true"></i>
								<h3>Thanh toán</h3>
								<p>Chấp nhận thanh toán online, offline cho tất cả đơn hàng.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box3">
								<i class="fa fa-battery-full" aria-hidden="true"></i>
								<h3>Phục vụ</h3>
								<p>Khuyến mãi, hậu mãi hàng tháng cho tri ân khách hàng.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box4">
								<i class="fa fa-users" aria-hidden="true"></i>
								<h3>Hổ trợ</h3>
								<p>Tư vấn online, trực tiếp bằng điện thoại, skype, viber...</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection