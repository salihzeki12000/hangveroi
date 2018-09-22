@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<h2 class="h2-title alert alert-danger">
					<i class="fa fa-user" aria-hidden="true"></i> Đăng nhập
				</h2>
			</div>
		</div>
		<div class="second-row">
			@if (Session::has('msg'))
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="alert alert-warning" role="alert">
							{{ Session::get('msg') }}
						</div>
					</div>
				</div>
			</div>
			@endif
			<div class="col-md-8 col-md-offset-2">
				<form method="post" action="{{ Request::url() }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="txt_email">Email</label>
						<input id="txt_email" class="form-control" type="email" name="email" value>
					</div>
					<div class="form-group">
						<label for="txt_password">Mật khẩu</label>
						<input id="txt_password" class="form-control" type="password" name="password" value>
					</div>
					<div class="form-group text-right">
						<a href="{{ URL::to('/account/register') }}" class="btn btn-waring">Đăng kí</a>
						<input class="btn btn-danger" name="submit" type="submit" value="Đăng nhập">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop