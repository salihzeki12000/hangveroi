@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="first-row">
			<div class="col-md-8">
				<h2 class="h2-title alert alert-danger">
					<i class="fa fa-user" aria-hidden="true"></i> Thông tin người nhận hàng
				</h2>
				{{ Session::get('city') }}
				<form method="post" action="{{ Request::url() }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="txt_name">Họ tên</label>
						<input id="txt_name" class="form-control" type="text" name="name" value="{{ Session::has('name') ? Session::get('name') : ''  }}">	
					</div>
					<div class="form-group">
						<label for="txt_phone">Điện thoại di động</label>
						<input id="txt_phone" class="form-control" type="text" name="phone" value="{{ Session::has('phone') ? Session::get('phone') : ''  }}">	
					</div>
					<div class="form-group">
						<label for="txt_city">Tỉnh/Thành Phố</label>
						<select class="selectpicker form-control cmbCity" name="city" id="txt_city">
							@foreach($cityItems as $item)
							@if(Session::has('city'))
							@if($item->id == Session::get('city'))
							<option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
							@else
							<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endif
							@else
							<option value="{{ $item->id }}">{{ $item->name }}</option>
							@endif
							@endforeach
						</select>	
					</div>
					<div class="form-group">
						<label for="txt_district">Quận/Huyện</label>
						<div id="cmbDistrict">
							<select class="selectpicker form-control cmbDistrict" name="district" id="txt_district">
								@if(Session::has('city'))
								@foreach(App\Models\City::find(Session::get('city')) as $item)
								<option value="{{ $item->id }}">{{ $item->type }} {{ $item->name }}</option>
								@endforeach
								@else
								@foreach($districtItems as $item)
								<option value="{{ $item->id }}">{{ $item->type }} {{ $item->name }}</option>
								@endforeach
								@endif
							</select>	
						</div>
					</div>
					<div class="form-group">
						<label for="txt_address">Địa chỉ</label>
						<textarea id="txt_address" class="form-control" type="text" name="address"></textarea>	
					</div>
					<div class="form-group text-right">
						<input class="btn btn-default" name="reset" type="reset" value="Huỷ bỏ">
						<input class="btn btn-danger" name="submit" type="submit" value="Tiếp theo">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop