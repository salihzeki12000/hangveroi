@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<h2 class="h2-title alert alert-danger">
					<i class="fa fa-user" aria-hidden="true"></i> Đăng kí thành viên
				</h2>
			</div>
		</div>
		<div class="second-row">
			<div class="col-md-8 col-md-offset-2">
				<!-- <div class="row">
					<div class="col-md-6">
						<a class="btn btn-100 btn-danger" href="{{ URL::to(Request::segment(1).'/login-with-google') }}">Login by Google</a>
					</div>
					<div class="col-md-6">
						<a class="btn btn-100 btn-primary" href="{{ URL::to(Request::segment(1).'/login-with-facebook') }}">Login by Facebook</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<br> -->
				<form id="register-form" method="post" action="{{ Request::url() }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="txt_name">Họ tên</label>
						<input id="txt_name" class="form-control" type="text" name="name" value required>	
					</div>
					<div class="form-group">
						<label for="txt_email">Email</label>
						<input id="txt_email" class="form-control" type="email" name="email" value required>	
					</div>
					<div class="form-group">
						<label for="txt_password">Mật khẩu</label>
						<input id="txt_password" class="form-control" type="password" name="password" value required>	
					</div>
					<div class="form-group">
						<label for="txt_phone">Điện thoại di động</label>
						<input id="txt_phone" class="form-control" type="text" name="phone" value required>	
					</div>
					<!-- <div class="form-group">
						<label for="txt_city">Tỉnh/Thành Phố</label>
						<select class="selectpicker form-control cmbCity" name="city" id="txt_city">
							@foreach($cityItems as $item)
							<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endforeach
						</select>	
					</div>
					<div class="form-group">
						<label for="txt_district">Quận/Huyện</label>
						<div id="cmbDistrict">
							<select class="selectpicker form-control cmbDistrict" name="district" id="txt_district">
								@foreach($districtItems as $item)
								<option value="{{ $item->id }}">{{ $item->type }} {{ $item->name }}</option>
								@endforeach
							</select>	
						</div>
					</div> -->
					<div class="form-group">
						<label for="txt_address">Địa chỉ</label>
						<textarea id="txt_address" class="form-control" type="text" name="address" required></textarea>	
					</div>
					<!-- <div class="form-group">
						<div class="g-recaptcha" data-sitekey="6LcdFQsUAAAAAPUZDklP-5KrPh34Rr868RxBmqGa"></div>
					</div> -->
					<div class="form-group text-right">
						<input class="btn btn-default" name="reset" type="reset" value="Huỷ bỏ">
						<input class="btn btn-danger" name="submit" type="submit" value="Đăng kí">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop