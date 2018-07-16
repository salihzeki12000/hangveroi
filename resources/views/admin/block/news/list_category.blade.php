<div class="form-group" style="margin-bottom:40px !important;">
	<div class="col-sm-9">
		<label>{{ trans('news.category') }}</label>
		<div class="col-sm-12 padding-0">
			<div class="col-sm-12 padding-0">
				<select name="category_id" id="classcategory" class="selectpicker form-control">
					@foreach($categoryItems as $item)
					@if($item['id'] == $category_id)
					<option selected="selected" value="{{ $item['id'] }}">{{ $item['name'] }}</option>
					@else
					<option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
					@endif
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<label>&nbsp;</label>
		<span class="btn ripple btn-raised btn-primary" data-toggle="modal" data-target="#addcategory">
			<div>
				<span>Add more</span>
				<span class="ink animate" style="height: 182px; width: 182px; top: -75px; left: 18.3438px;"></span>
			</div>
		</span>
		<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Category</h4>
					</div>
					<div class="modal-body">
						<div class="form-group form-animate-text">
							<input type="text" class="form-text" id="newcategory" value="" name="newcategory">
							<span class="bar"></span>
							<label>Category</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" data-token="{{ csrf_token() }}" class="addcategory btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			$('.addcategory').on('click', function(){
				var producttype_name = $('#newcategory').val();
				var token = $(this).data('token');
				$.ajax({
					url: _base_url + "api/category",
					type: 'post',
					data: {
						name: producttype_name,
						_token: token
					}
				})
				.done(function(html) {
					if (html != "false") {
						console.log(html);
						$('#addcategory').remove();
						$('.modal-backdrop').remove();
						$('#classcategory').html(html);
						$('#classcategory').selectpicker('refresh');
						$('body').removeClass('modal-open');
					} else {
						BootstrapDialog.show({
							type: BootstrapDialog.TYPE_WARNING,
							title: 'Error',
							message: 'No article has been save.'
						});
					}
				})
				.fail(function() {
					BootstrapDialog.show({
						type: BootstrapDialog.TYPE_DANGER,
						title: 'Error',
						message: 'Connection error'
					});
				});
			});
		</script>
	</div>
</div>