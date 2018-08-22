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
					<form>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
