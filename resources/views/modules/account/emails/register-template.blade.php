<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="width: 600px; font-family: Arial; font-size: 12px; border: 1px solid #666;">
	<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
	<table style="width: 100%">
		<thead>
			<tr>
				<th colspan="2">
					<div style="background: #0c5f44; width: 100%; display: block; overflow: hidden;">
						<a href="http://ohangveroi.com">
							<img style="width: 200px; float: left; padding: 10px" src="https://ohangveroi.com/assets/img/logo.png">
						</a>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2" style="padding: 5px;">
					Thành viên mới đăng kí
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					Họ tên: 
				</td>
				<td style="padding: 5px;">
					{{ $cus_name }}
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					Email: 
				</td>
				<td style="padding: 5px;">
					{{ $email }}
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					Số điện thoại: 
				</td>
				<td style="padding: 5px;">
					{{ $cus_phone }}
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					Địa chỉ: 
				</td>
				<td style="padding: 5px;">
					{{ $cus_address }}
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<thead>
			<tr>
				<th colspan="2">
					<div style="background: #0c5f44; width: 100%; display: block; overflow: hidden; color: #fff; text-align: left;">
						<p style="margin: 0; padding: 0 5px 20px 5px;"><b>Ohangveroi.com ! Kênh bán lẻ rẻ nhất Việt Nam.</b></p>
					</div>
				</th>
			</tr>
		</thead>
	</table>
</body>
</html>