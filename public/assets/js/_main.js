$(document).ready(function(){
	$(".changeStatus").click(function() {
		var that = $(this);
		var id = $(this).data('id');
		var segment1 = $(this).data('segment1');
		var segment2 = $(this).data('segment2');
		var segment3 = $(this).data('segment3');
		var title = $(this).data('name');
		var token = $(this).data('token');

		if(typeof(segment3) == 'undefined') {
			segment3 = '';
		} else {
			segment3 = '/' + segment3;
		}

		$.ajax({
			url: _base_url + segment1 + "/" + segment2 + segment3 + "/change",
			type: 'post',
			data: {
				id: id,
				_token: token
			}
		})
		.done(function(html) {
			if (html == "false") {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Error',
					message: 'The article does not exist.'
				});
			}
			else if (html == "published") {
				$(that).html('<span class="btn btn-outline btn-success" style="width: 100px;">Published <span class="fa fa-check"></span></span>');
			}
			else if (html == "pending") {
				$(that).html('<span class="btn btn-outline btn-danger" style="width: 100px;">Pending <span class="fa fa-times"></span></span>');
			}
		})
		.fail(function() {
			BootstrapDialog.show({
				type: BootstrapDialog.TYPE_DANGER,
				title: 'Error',
				message: 'Connection error'
			});
		});				
		return false;
	});

	$(".deleleItem").click(function() {
		var id = $(this).data('id');
		var segment1 = $(this).data('segment1');
		var segment2 = $(this).data('segment2');
		var segment3 = $(this).data('segment3');
		var title = $(this).data('name');
		var token = $(this).data('token');

		var x = Math.floor((Math.random() * 10) + 1);
		var y = Math.floor((Math.random() * 10) + 1);
		var message = "You are about to delete the article:\n" + title + "\n\n Are you sure?";

		if(typeof(segment3) == 'undefined') {
			segment3 = '';
		} else {
			segment3 = '/' + segment3;
		}

		BootstrapDialog.show({
			title: 'Are you conscious?',
			message: x + ' + ' + y + ' = ? <br/><input class="form-control" />',
			buttons: [{
				cssClass: 'btn-primary',
				hotkey: 13,
				label: 'Of course!',
				action: function(dialogRef) {
					var value = dialogRef.getModalBody().find('input').val();
					value = parseInt(value);

					if(value != x + y) {
						BootstrapDialog.show({
							type: BootstrapDialog.TYPE_WARNING,
							title: 'Error',
							message: x + ' + ' + y + ' != ' + value
						});
						return false;
					}
					dialogRef.close();
					BootstrapDialog.confirm(message, function(result) {
						if (result) {
							$.ajax({
								url: _base_url + segment1 + "/" + segment2 + segment3 + "/delete",
								type: 'post',
								data: {
									id: id,
									_token: token
								}
							})
							.done(function(html) {
								if (html == "true") {
									BootstrapDialog.show({
										type: BootstrapDialog.TYPE_SUCCESS,
										title: 'Success',
										message: 'The article has been deleted!'
									});
									$("#article-" + id).remove();
								} else {
									BootstrapDialog.show({
										type: BootstrapDialog.TYPE_WARNING,
										title: 'Error',
										message: 'The article does not exist.'
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
						}
					}); 
				}
			}]
		});
		return false;
	});
});