<div class="form-group" style="margin-bottom:40px !important;">
	<div class="col-sm-9">
		<label>{{ trans('product.producttype') }}</label>
		<div class="col-sm-12 padding-0">
			<div class="col-sm-12 padding-0">
				<select name="product_type" id="classproducttype" class="selectpicker form-control">
					@foreach($productTypeItems as $item)
					@if($item['id'] == $product_type)
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
		<span class="btn ripple btn-raised btn-primary" data-toggle="modal" data-target="#addproducttype">
			<div>
				<span>Add more</span>
				<span class="ink animate" style="height: 182px; width: 182px; top: -75px; left: 18.3438px;"></span>
			</div>
		</span>
		<div class="modal fade" id="addproducttype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Product Type</h4>
					</div>
					<div class="modal-body">
						<div class="form-group form-animate-text">
							<input type="text" class="form-text" id="newproducttype" value="" name="newproducttype">
							<span class="bar"></span>
							<label>Product type</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" data-token="{{ csrf_token() }}" class="addproducttype btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			$('.addproducttype').on('click', function(){
				var producttype_name = $('#newproducttype').val();
				var token = $(this).data('token');
				$.ajax({
					url: _base_url + "api/product-type",
					type: 'post',
					data: {
						name: producttype_name,
						_token: token
					}
				})
				.done(function(html) {
					if (html != "false") {
						console.log(html);
						$('#addproducttype').remove();
						$('.modal-backdrop').remove();
						$('#classproducttype').html(html);
						$('#classproducttype').selectpicker('refresh');
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