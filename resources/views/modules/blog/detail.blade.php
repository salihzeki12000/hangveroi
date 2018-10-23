@extends('layouts.default')
@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="first-row">
			<div class="col-md-12">
				<div class="breadcmenu">
					<ol class="breadcrumb">
						<li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
						<li><a href="{{-- URL::to('/blog') --}}">Tin tức</a></li>
						<li>{{ $article->name }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="second-row">
			<div class="col-md-12">
				<div class="module-row">
					<div class="row">
						<div class="col-md-12">
							@if($article->image_thumb != 0)
							@if (!empty(App\Models\Gallery::find($article->image_thumb)))
							<img class="img-responsive img-thumbnail margin-bottom-5" style="width: 100%; height: auto;" src="{{ App\Models\Base::get_upload_url($article->getImage->filename) }}" alt="{{ $article['name'] }}">
							@endif
							@endif
							<div>
								{!! $article->content !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop