<?php namespace Modules\Cart\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Html;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Base;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use Cart;
use Redirect;
use Auth;

class CartController extends Controller {
	
	public function index()
	{
		return view('cart::index');
	}

	public static function getCartTotal()
	{
		return Cart::count();
	}

	public function listCartAjax(Request $request)
	{

	}

	public function addCart(Request $request)
	{
		$id = $request->id;
		$product = Product::find($id);
		Cart::add(
			array(
				'id' 		=> $id, 
				'name' 		=> $product->name, 
				'price' 	=> $product->price, 
				'qty' 		=> 1,
				'options'	=>array(
					'image' => Base::get_upload_url($product->getImage->filename),
					'slug' 	=> $product->slug,
					)
				)
			);
		$this->data['cart'] = Cart::content();
		return view('cart::list-cart-ajax');
	}

	public function destroyCart(Request $request)
	{
		$request->session()->flush();
		Cart::destroy();
	}

	public function checkout(Request $request)
	{
		$this->data['_header'] =    
		Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
		Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');

		$segment = $request->segment(3);
		$array_segment = explode('-', $segment);
		$step = end($array_segment);
		if($step == 1) {
			if(Auth::check())
			{
				$request->session()->put('name', Auth::user()->name);
				$request->session()->put('phone', Auth::user()->phone);
				$request->session()->put('city', Auth::user()->city);
				$request->session()->put('district', Auth::user()->district);
				$request->session()->put('address', Auth::user()->address);
			}
			if($request->has('submit') == true)
			{
				$request->session()->put('name', $request->name);
				$request->session()->put('phone', $request->phone);
				$request->session()->put('city', $request->city);
				$request->session()->put('district', $request->district);
				$request->session()->put('address', $request->address);

				return Redirect::to($request->segment(1)."/".$request->segment(2)."/step-2")->with($request->session);
			}
			$this->data['cityItems'] 		= City::orderBy('id', 'ASC')->get();
			$this->data['districtItems'] 	= District::where('city_id', 79)->orderBy('name', 'ASC')->get();
			$this->data['_title'] 			= 'Thông tin giao hàng';
			return view('cart::info-user')->with($this->data);
		} 
		if($step == 2) {
			$this->data['_title'] = 'Giỏ hàng của bạn';
			return view('cart::list-cart')->with($this->data);
		}
	}

	// public function Order(Request $request)
	// {
	// 	$this->data['_title'] = 'Hoàn tất đơn hàng';
	// 	return view('cart::success')->with($this->data);
	// }

	public function doOrder(Request $request)
	{
		if($request->session()->has('name')) {
			$order_item = new Order();
			$order_item->user_id = $request->session()->has('name') ? $request->session()->has('name') : 0;
			$order_item->cus_name = $request->session()->get('name');
			$order_item->cus_phone = $request->session()->get('phone');
			$order_item->cus_email = $request->session()->get('email');
			$order_item->cus_address = $request->session()->get('address');
			$order_item->city_id = $request->session()->get('city');
			$order_item->district_id = $request->session()->get('district');
			$order_item->total_price = Cart::subtotal();
			$order_item->qty = Cart::count();
			if($order_item->save()) {
				foreach(Cart::content() as $item) {
					$order_detail_item = new OrderDetail();
					$order_detail_item->product_id = $item->id;
					$order_detail_item->product_name = $item->name;
					$order_detail_item->product_price = $item->price;
					$order_detail_item->product_qty = $item->qty;
					$order_detail_item->order_id = $order_item->id;
					$order_detail_item->save();
				}
				Cart::destroy();
				return view('cart::success')->with($request->session()->flash('status', 'Đơn hàng của bạn đã được cập nhật thành công'));
			}
		} else { 
			return Redirect::to($request->segment(1)."/".$request->segment(2)."/step-1");
		}
	}

	public function updateQuantityProduct(Request $request)
	{
		$id_product = $request->id;
		$qty_product = $request->qty;
		$rowid = $request->rowid;
		Cart::update($rowid, $qty_product);
	}
	
}