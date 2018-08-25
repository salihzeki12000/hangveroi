@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li>Tài khoản của tôi</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-3 left-position">
				<div class="wrapmenu">
					<p class="margin-bottom-0">Tài khoản của</p>
					<h2 class="userNameLeft">{{ Auth::user()->name }}</h2>
					@include('account::layouts.left_menu')
				</div>
			</div>
			<div class="col-md-9 right-position">
				<div class="wrapListProduct">
					@if (Session::has('msg'))
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-success" role="alert">
								{{ Session::get('msg') }}
							</div>
						</div>
					</div>
					@endif
					<div class="row">
						<div class="col-md-8">
							<form method="post" action="{{ Request::url() }}">
								{{ csrf_field() }}
								<div class="form-group row">
									<label for="username" class="col-sm-3 col-form-label custom-label">Họ tên</label>
									<div class="col-sm-9">
										<input type="text" name="username" class="form-control" id="username" placeholder="Họ tên" value="{{ Auth::user()->name }}">
									</div>
								</div>
								<div class="form-group row">
									<label for="phone" class="col-sm-3 col-form-label custom-label">Số điện thoại</label>
									<div class="col-sm-9">
										<input type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại" value="{{ Auth::user()->phone }}">
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-sm-3 col-form-label custom-label">Email</label>
									<div class="col-sm-9">
										<input type="text" name="email" class="form-control" id="email" placeholder="Email" disabled value="{{ Auth::user()->email }}">
									</div>
								</div>
								<div class="form-group row">
									<label for="address" class="col-sm-3 col-form-label custom-label">Địa chỉ</label>
									<div class="col-sm-9">
										<textarea name="address" id="address" style="width: 100%; padding: 10px;" rows="3" placeholder="Nhập chính xác địa chỉ để dễ dàng nhận hàng hơn">{{ Auth::user()->address }}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12 pull-right text-right">
										<button type="submit" name="submit" class="btn btn-primary mb-2">Cập nhập</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
