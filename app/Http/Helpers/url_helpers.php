<?php 
use App\Models\Product;

function admin_link_helper($type = "", $id = "", $link = "")
{
	if($id != "") {
		if(is_numeric($id)){
			if($type == trim('view')) {
				$url = URL::to(Request::segment(1).'/'.Request::segment(2). $link .'/view/'.$id);
			}
			if($type == trim('edit')) {
				$url = URL::to(Request::segment(1).'/'.Request::segment(2). $link .'/edit/'.$id);
			}
			if($type == trim('delete')) {
				$url = URL::to(Request::segment(1).'/'.Request::segment(2). $link .'/delete/'.$id);
			}
			if($type == trim('status')) {
				$url = URL::to(Request::segment(1).'/'.Request::segment(2). $link .'/status/'.$id);
			}
		} else {
			$url = URL::to(Request::segment(1).'/404/');
		}
	} else {
		$url = URL::to(Request::segment(1).'/'.Request::segment(2). $link .'/create');
	}
	return $url;
}

function substr_word($body,$maxlength)
{
	if (strlen($body)<$maxlength) return $body;
	$body = substr($body, 0, $maxlength);
	$rpos = strrpos($body,' ');
	if ($rpos>0) $body = substr($body, 0, $rpos);
	return $body;
}

function cleanVietnamese($str)
{
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ',
		'd'=>'đ|ð',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ',
		'D'=>'Đ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë',
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
	foreach($unicode as $nonUnicode=>$uni)
	{
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	return $str;
}

function product_price($priceFloat) {
	$symbol = 'đ';
	$symbol_thousand = '.';
	$decimal_place = 0;
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price.$symbol;
}

function display_status($statusCode)
{
	switch ($statusCode) {
		case 'new':
			$status = "Đơn mới tạo";
			break;
		case 'shipping':
			$status = "Đang được vận chuyển";
			break;
		case 'cancel':
			$status = "Đã hủy";
			break;
		case 'handle':
			$status = "Đã xữ lý";
			break;
		case 'success':
			$status = "Đơn hàng thành công";
			break;
		default:
			$status = "Đơn mới tạo";
			break;
	}
	return $status;
}