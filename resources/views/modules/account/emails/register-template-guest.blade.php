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
					<b><p>Xin chào {{ $cus_name }},</p></b>
					<p>Lời đầu tiên xin cảm ơn vì bạn đã là một phần của cộng đồng mua hàng trực tuyến Ohangveroi.com</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="padding: 5px;">
					<b>Thông tin đăng nhập của bạn đây ạ! </b>
				</td>
			</tr>
			<tr>
				<td style="padding: 5px; width: 20%">
					Email: 
				</td>
				<td style="padding: 5px;">
					{{ $email }}
				</td>
			</tr>
			<tr>
				<td style="padding: 5px;">
					Password: 
				</td>
				<td style="padding: 5px;">
					******* <i>(Vì lý do bảo mật, bạn tự nhớ nhé! ^^)</i>
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
			<tr>
				<td colspan="2" style="padding: 5px;">
					<b>Bạn hãy <a style="color: red;" href="https://ohangveroi.com/account/login">đăng nhập và mua hàng</a> để được giảm 5% từ hệ thống ohangveroi.com nhé</b> <br>
					Cam kết giảm ngay 5% trên tất cả các sản phẩm. <br>
					Ohangveroi.com giao hàng miễn phí khắp các quận trong thành phố Hồ Chí Minh cho đơn hàng chỉ từ 100.000đ.
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%">
		<tbody>
			<tr valign="top">
				<td style="width: 20%">
					<a style="color: #0c5f44; text-decoration: none" href="https://ohangveroi.com/product/khay-mut-lua-mach-105"><img style="width: 100%" src="https://ohangveroi.com/assets/uploads/products/products_20181013-1539412023.4512_medium.jpg" alt="">Khay mứt lúa mạch<p style="color: red; font-weight: bold">110.000đ</p></a>
				</td>
				<td style="width: 20%">
					<a style="color: #0c5f44; text-decoration: none" href="https://ohangveroi.com/product/den-ngu-cam-ung-anh-sang-hinh-nam-doi-mau-86"><img style="width: 100%" src="https://ohangveroi.com/assets/uploads/products/products_20180919-1537363937.9723_medium.jpg" alt="">Đèn ngủ cảm ứng ánh sáng hình nấm đổi màu<p style="color: red; font-weight: bold">25.000đ</p></a>
				</td>
				<td style="width: 20%">
					<a style="color: #0c5f44; text-decoration: none" href="https://ohangveroi.com/product/tui-dung-chan-man,-quan-ao-dang-doc-72"><img style="width: 100%" src="https://ohangveroi.com/assets/uploads/products/products_20180910-1536589023.4085_medium.jpeg" alt="">Túi đựng chăn màn, quần áo dáng dọc<p style="color: red; font-weight: bold">30.000đ</p></a>
				</td>
				<td style="width: 20%">
					<a style="color: #0c5f44; text-decoration: none" href="https://ohangveroi.com/product/mieng-rua-chen-silicon-84"><img style="width: 100%" src="https://ohangveroi.com/assets/uploads/products/products_20180918-1537274840.7968_medium.jpeg" alt="">Miếng rửa chén silicon<p style="color: red; font-weight: bold">15.000đ</p></a>
				</td>
				<td style="width: 20%">
					<a style="color: #0c5f44; text-decoration: none" href="https://ohangveroi.com/product/bot-tay-ve-sinh-long-may-giat-han-quoc-450g-88"><img style="width: 100%" src="https://ohangveroi.com/assets/uploads/products/products_20180919-1537364138.353_medium.jpg" alt="">Bột tẩy vệ sinh lồng máy giặt Hàn Quốc<p style="color: red; font-weight: bold">49.000đ</p></a>
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<thead>
			<tr>
				<th colspan="2">
					<div style="background: #0c5f44; width: 100%; display: block; overflow: hidden; color: #fff; text-align: left;">
						<p style="padding: 0 5px;">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể liên hệ trực tiếp HOTLINE: <b>0969 292 449</b> để được tư vấn nhanh nhất</p>
						<p style="margin: 0; padding: 0 5px 20px 5px;"><b>Một lần nữa Ohangveroi.com cảm ơn quý khách.</b></p>
					</div>
				</th>
			</tr>
		</thead>
	</table>
</body>
</html>