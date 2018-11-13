<?php

namespace App\Http\Controllers;

use Html;
use Session;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Product;
use App\Models\Page;
use App\Models\District;
use App\Models\Banner;

class HomeController extends Controller
{
	public function index()
	{
		$this->data['_header'] =   
		Html::style('plugins/bxslider/jquery.bxslider.css').
		Html::script('plugins/bxslider/jquery.bxslider.min.js').

		Html::style('plugins/owl-carousel/owl.carousel.css').
		Html::style('plugins/owl-carousel/owl.theme.css').
		Html::script('plugins/owl-carousel/owl.carousel.min.js');

		$this->data['main_sliders'] = Banner::where('location', 'main_slider')->limit(5)->get();
		$this->data['right_indexs'] = Banner::where('location', 'right_index_page')->limit(2)->get();

		$this->data['_title'] = "Hàng Về Rồi - Đồ Gia Dụng Tiện Ích";
		$this->data['_description'] = "Hàng Về Rồi - Đồ Gia Dụng Tiện Ích";

		return view('modules.home.index')->with($this->data);
	}

	public function getPages(Request $request) 
	{
		$segment = trim($request->segment(1));
		$articleItem = Page::where('slug', $segment)->first();

		$this->data['articleItem'] = $articleItem;

		$this->data['_title'] = $articleItem->name;
		$this->data['_description'] = $articleItem->name;
		return view('modules.page.detail')->with($this->data);
	}

	public function getDistrict(Request $request) 
	{
		$id = $request->id;
		$districtItems = District::where('province_id', $id)->get();
		echo '<select class="selectpicker form-control cmbDistrict" name="district" id="txt_district">';
		foreach($districtItems as $item) {
			echo '<option value="'. $item->id .'">' . $item->type . ' ' . $item->name .'</option>';
		}
		echo '</select>';
	}
	public function searchAction(Request $request)
	{
		$keywords = $request->keyword;
		if ($keywords=="") {
			$this->data['_title'] = "Bạn cần tìm kiếm gì trên Ohangveroi.com?";
			$this->data['_description'] = "Bạn cần tìm kiếm gì trên Ohangveroi.com?";
		} else {
			$products = Product::where('name', 'LIKE', "%".$keywords."%")->orWhere('descriptions', 'LIKE', "%".$keywords."%")->orWhere('specifications', 'LIKE', "%".$keywords."%")->orderBy('created_at', 'DESC')->get();
			$this->data['productItems'] = $products;
			$this->data['_title'] = "Kết quả cho " . $keywords;
		}
		return view('modules.home.search')->with($this->data);
	}
}
