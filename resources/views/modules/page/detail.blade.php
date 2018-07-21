@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('') }}">Trang chủ</a></li>
						<li class="active">{{ $articleItem->name }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-12">
				<div class="box-content">
					{!! $articleItem->content !!}
					<br>
					@if($articleItem->slug == 'contact')
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.3004554568543!2d106.60504241418356!3d10.864736892261613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a149465a451%3A0x137a3c03853fdd8a!2zxJDhu5NuZyBUw6JtLCBUcnVuZyBDaMOhbmgsIFTDom4gWHXDom4sIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1532180340571" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection