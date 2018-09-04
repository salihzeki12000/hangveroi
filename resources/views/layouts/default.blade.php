<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{!! isset($_title) ? $_title : '734771876860976' !!}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favico.png') }}" />
	<meta name="_token" content="{{ csrf_token() }}">	
	<meta name="description" content="{!! isset($_description) ? $_description : '' !!}">
	<meta property="fb:app_id" content="734771876860976" />
	<meta property="og:url" content="{{ Request::url() }}" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="{!! isset($_title) ? $_title : '' !!}" />
	<meta property="og:description" content="{!! isset($_description) ? $_description : '' !!}" />
	<meta property="og:image" content="{{ isset($_image) ? $_image : 'https://ohangveroi.com/assets/uploads/banners/banners_20180821-1534863143.3716_medium.png' }}" />

	@if(Request::segment(1) == 'product' && Request::segment(2) != 'type')
	<meta property="product:brand" content="Ohangveroi.com">
	<meta property="product:availability" content="còn hàng">
	<meta property="product:condition" content="mới">
	<meta property="product:price:amount" content="{{ $articleItem['price'] }}">
	<meta property="product:price:currency" content="VND">
	<meta property="product:retailer_item_id" content="dogiadung">
	@endif
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/plugins/bootstrap-dropdown/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/plugins/bootstrap-dropdown/css/bootstrap-dropdownhover.min.css">
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/assets/css/helpers.css">
	<link rel="stylesheet" type="text/css" href="https://st.ohangveroi.com/assets/css/stylesheet.css?v=1">
	
	<script type="text/javascript" src="https://st.ohangveroi.com/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://st.ohangveroi.com/plugins/bootstrap-dropdown/js/bootstrap-dropdownhover.min.js"></script>
	<script type="text/javascript" src="https://st.ohangveroi.com/plugins/bootstrap-notify/bootstrap-notify.js"></script>
	<script type="text/javascript" src="https://st.ohangveroi.com/assets/js/top.js"></script>

	{!! isset($_header) ? $_header : '' !!}
	<script>
		var _base_url = "{{ URL::to('') }}" + "/";
	</script>
	{!! App\Models\Setting::where('key', 'google_analytics_config')->first()["value"] !!}
	<!-- Facebook Pixel Code -->
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M8VV393');</script>
<!-- End Google Tag Manager -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1222128491214717');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=1222128491214717&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8VV393"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
			<script>
				window.fbAsyncInit = function() {
					FB.init({
						appId      : '734771876860976',
						xfbml      : true,
						version    : 'v3.1'
					});

					FB.AppEvents.logPageView();

				};

				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "https://connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<script src="https://apis.google.com/js/platform.js" async defer>
				{lang: 'vi'}
			</script>
			@if(Request::segment(1) == 'product' && Request::segment(2) != 'type')
			<script>
				fbq('track', 'ViewContent', {
					currency: 'VND',
					content_type: 'product',
					content_ids: {{ $articleItem["id"] }},
					content_name: '{!! $articleItem["name"] !!}',
					value: '{{ $articleItem["price"] }}',
					content_category: '{!! $articleItem->getProductType->name !!}'
				});
			</script>
			@endif
			<script>
				fbq('track', 'Lead');
			</script>
			<div class="row">
				<div class="container-fluid">
					<header>
						<div class="container">
							<div id="intro">
								<div class="pull-left">
									{{ App\Models\Setting::where('key', 'intro_text')->first()["value"] }}
								</div>
								<div class="pull-right">
									@if(Auth::check())
									Xin chào <a href="{{ URL::to('account') }}">{{ Auth::user()->name }}</a>
									@else
									<a href="{{ URL::to('account/register') }}">Đăng kí</a> / <a href="{{ URL::to('account/login') }}">Đăng nhập</a>
									@endif
								</div>
							</div>
						</div>
						<div class="wrap-menu">
							<div class="container">
								<div class="row">
									<nav class="navbar navbar-inverse" role="navigation">
										<div class="container-fluid">
											<div class="navbar-header">
												<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mnu-button">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												<a href="{{ URL::to('') }}" title="">
													<img src="{{ asset('assets/img/logo.png') }}" alt="">
												</a>
											</div>
											<div class="collapse navbar-collapse" id="mnu-button" data-hover="dropdown" data-animations="">
												<ul class="nav navbar-nav">
													<li>
														<a href="{{ URL::to('') }}">Trang chủ</a>
													</li>
													<li>
														<a href="{{ URL::to('/product/type/do-dung-tien-ich-13') }}">Đồ dùng tiện ích</a>
													</li>
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Đồ gia dụng<span class="caret"></span></a>
														<ul class="dropdown-menu dropdownhover-bottom" role="menu" style="">
															<li><a href="{{ URL::to('product/type/do-dung-gia-dinh-5') }}">Đồ dùng gia đình</a></li>
															<li><a href="{{ URL::to('product/type/dung-cu-lam-bep-10') }}">Dụng cụ làm bếp</a></li>
													<!-- <li class="dropdown">
														<a href="#">Another dropdown <span class="caret"></span></a>
														<ul class="dropdown-menu dropdownhover-right">
															<li><a href="#">Action</a></li>
															<li><a href="#">Another action</a></li>
															<li><a href="#">Something else here</a></li>
															<li class="divider"></li>
															<li><a href="#">Separated link</a></li>
															<li class="divider"></li>
															<li><a href="#">One more separated link</a></li>
														</ul>
													</li>
													<li class="dropdown">
														<a href="#">Another dropdown 2 <span class="caret"></span></a>
														<ul class="dropdown-menu dropdownhover-right">
															<li><a href="#">Action</a></li>
															<li><a href="#">Another action</a></li>
															<li><a href="#">Another action</a></li>
															<li class="dropdown">
																<a href="#">Another dropdown <span class="caret"></span></a>
																<ul class="dropdown-menu dropdownhover-right">
																	<li><a href="#">Action</a></li>
																	<li><a href="#">Another action</a></li>
																	<li><a href="#">Something else here</a></li>
																	<li class="divider"></li>
																	<li><a href="#">Separated link</a></li>
																	<li class="divider"></li>
																	<li><a href="#">One more separated link</a></li>
																</ul>
															</li>
															<li><a href="#">Something else here</a></li>
															<li class="divider"></li>
															<li><a href="#">Separated link</a></li>
															<li class="divider"></li>
															<li><a href="#">One more separated link</a></li>
														</ul>
													</li>
													<li><a href="#">Something else here</a></li>
													<li class="divider"></li>
													<li><a href="#">Separated link</a></li>
													<li class="divider"></li>
													<li><a href="#">One more separated link</a></li> -->
												</ul>
											</li>
											<!-- <li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown 2 <span class="caret"></span></a>
												<ul class="dropdown-menu dropdownhover-bottom" role="menu">
													<li><a href="#">Action</a></li>
													<li><a href="#">Another action</a></li>
													<li><a href="#">Something else here</a></li>
													<li class="divider"></li>
													<li><a href="#">Separated link</a></li>
													<li class="divider"></li>
													<li><a href="#">One more separated link</a></li>
												</ul>
											</li> -->
											<li>
												<a href="{{ URL::to('contact') }}">
													Liên hệ
												</a>
											</li>
										</ul>
										<div class="cart-list" id="cart-list">
											<ul class="nav navbar-nav navbar-right">
												<li class="dropdown">
													<a href="{{ URL::to('/cart/checkout/list') }}" class="dropdown-toggle shopping-cart">
														<span class="quantity">{{ Cart::count() }}</span>
														<i style="color: #fff" class="fa fa fa-shopping-cart" aria-hidden="true"></i>
														Giỏ hàng
													</a>
													<ul class="dropdown-menu dropdownhover-bottom sub-cart" role="menu" id="sub-cart">
														@if (Cart::count() > 0)
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
														@else
														<li>
															<a href="">
																<div class="name">
																	Không có sản phẩm nào trong giỏ
																</div>
															</a>
														</li>
														@endif
														<li class="divider"></li>
														<li><a style="color: #cc0000" href="{{ URL::to('cart/checkout/list') }}">Xem giỏ hàng <i class="fa fa-check fa-2x" aria-hidden="true"></i></a></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</nav>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<form action="{{ URL::to('/search?') }}" method="GET">
									<div class="input-group box-outline">
										<input type="hidden" name="_token" value={{ csrf_token() }}>
										<input type="text" name="keyword" class="form-control border-radius-top-bottom-left-5" placeholder="Tìm kiếm trên Ô hàng về rồi">
										<span class="input-group-btn">
											<button class="btn btn-default border-radius-top-bottom-right-5" type="submit"><i class="fa fa-search"></i> Tìm ngay!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div id="body">
				<div class="row">
					<div class="container">
						<div class="col-md-12">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
			<footer>
				<div class="row">
					<div class="footer-row">
						<div class="col-md-12">
							<div class="box-bg-default-footer">
								<div class="footer-box container">
									<div class="col-md-3">
										<h4>Chăm sóc khách hàng</h4>
										<ul class="list-link">
											<li><a class="link-footer" href="#">Liên hệ</a></li>
											<li><a class="link-footer" href="#">Trả hàng</a></li>
											<li><a class="link-footer" href="#">Sơ đồ trang</a></li>
											<li><a class="link-footer" href="#">Khuyến mãi</a></li>
											<li><a class="link-footer" href="#">Hậu mãi</a></li>
										</ul>
									</div>
									<div class="col-md-3">
										<h4>Tài khoản của tôi</h4>
										<ul class="list-link">
											<li><a class="link-footer" href="#">Tài khoản</a></li>
											<li><a class="link-footer" href="#">Lịch sử mua hàng</a></li>
											<li><a class="link-footer" href="#">Danh sách yêu thích</a></li>
											<li><a class="link-footer" href="#">Hộp thư</a></li>
										</ul>
									</div>
									<div class="col-md-3">
										<h4>Liên hệ</h4>
										<ul class="list-link">
											<li>Cung cấp sỉ và lẻ các sản phẩm gia dụng chất lượng cao.</li>
											<li><i class="fa fa-map-marker" aria-hidden="true"></i> Hồ Chí Minh - Việt Nam</li>
											<li><i class="fa fa-phone" aria-hidden="true"></i> 0969 292 449</li></li>
											<li><i class="fa fa-envelope-o" aria-hidden="true"></i> thebaoit@gmail.com</li>
										</ul>
									</div>
									<div class="col-md-3">
										<h4>Mạng xã hội</h4>
										<ul class="list-link">
											<li>Tìm chúng tôi qua</li>
											<li><a class="link-footer" target="_blank" title="Facebook Hàng về rồi ! Giao hàng miễn phí" href="https://www.facebook.com/hangveroihcm/"><i class="fa fa-facebook-square" aria-hidden="true"></i>&nbsp; Facebook</a></li>
											<li><a class="link-footer" href="#"><i class="fa fa-youtube-square" aria-hidden="true"></i>&nbsp; Youtube</a></li>
											<li><a class="link-footer" href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i>&nbsp; Twitter</a></li>
											<li><a class="link-footer" href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i>&nbsp; Google +</a></li>
										</ul>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<div class="col-md-12">
						<div class="container">
							<div class="col-md-12">
								<span class="pull-left">Copyright @ 2018 by Markwebgroup.com</span>
								<span class="pull-right">
									<a href="#"><i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i> &nbsp; </a>
									<a href="#"><i class="fa fa-cc-paypal fa-2x" aria-hidden="true"></i> &nbsp; </a>
									<a href="#"><i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i></a>
								</span>
								<br><br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
</div>
</body>
</html>