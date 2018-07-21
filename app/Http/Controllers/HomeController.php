<?php

namespace App\Http\Controllers;

use Html;
use Session;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Product;
use App\Models\Page;
use App\Models\District;

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

		$this->data['_title'] = "Hàng Về Rồi - Đồ Gia Dụng Tiện Ích";
		$this->data['_description'] = "Hàng Về Rồi - Đồ Gia Dụng Tiện Ích";

		return view('modules.home.index')->with($this->data);
	}

	public function getPages(Request $request) 
	{
		$segment = trim($request->segment(1));
		$articleItem = Page::where('slug', $segment)->first();

		$this->data['articleItem'] = $articleItem;

		$this->data['_title'] = "Page";
		return view('modules.page.detail')->with($this->data);
	}

	public function getDistrict(Request $request) 
	{
		$id = $request->id;
		$districtItems = District::where('city_id', $id)->get();
		echo '<select class="selectpicker form-control cmbDistrict" name="district" id="txt_district">';
		foreach($districtItems as $item) {
			echo '<option value="'. $item->id .'">' . $item->type . ' ' . $item->name .'</option>';
		}
		echo '</select>';
	}
}
