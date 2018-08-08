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
use Session;
use Mail;

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
		return response()->json([
			'cart' => Cart::content(), 
			'total' => Cart::total(),
			'totalQty' => Cart::count(),
			'error' => false
		]);
	}

	public function destroyCart(Request $request)
	{
		$request->session()->flush();
		Cart::destroy();
	}

	public function success(Request $request)
	{
		if (Cart::count() > 0) {
			return redirect()->to('/cart/checkout/list');
		} else {
			Session::forget('customername');
			Session::forget('customerphone');
			Session::forget('customeraddress');
			$this->data['_title'] = 'Đặt hàng thành công!';
			$this->data['_description'] = 'Quý khách đã đặt hàng thành công trên website Ohangveroi.com. Cám ơn quý khách đã mua hàng của chúng tôi. Quý khách có thể liên hệ 0969 292 449 trong trường hợp cần thiết';
			return view('cart::success')->with($this->data);
		}
	}

	public function doOrder(Request $request)
	{
		if ($request->submit) {
			$order_item = new Order();
			if (Auth::check()) {
				$order_item->user_id = Auth::user()->id;	
			}
			$order_item->cus_name = $request->session()->get('customername');
			$order_item->cus_phone = $request->session()->get('customerphone');
			$order_item->cus_address = $request->session()->get('customeraddress');
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
				$data = array(
					'carts' => Cart::content(),
					'cus_name' => $request->session()->get('customername'),
					'cus_phone' => $request->session()->get('customerphone'),
					'cus_address' => $request->session()->get('customeraddress')
				);
				Mail::send('emails.new_order', $data, function ($message) use ($data) {
                    $message->from('info@ohangveroi.com', 'Ohangveroi new Order')
                        ->to('thebaoit@gmail.com', 'Nguyen The Bao')
                        ->subject('[NEW ORDER] ' . $data['cus_name'] . ' - ' . $data['cus_phone']);
                });
				Cart::destroy();
				return redirect()->to('/cart/checkout/success');
			}
		}
	}

	public function updateQuantityProduct(Request $request)
	{
		$id_product = $request->id;
		$qty_product = $request->qty;
		$rowid = $request->rowid;
		Cart::update($rowid, $qty_product);
	}

	public function cartList(Request $request)
	{
		$this->data['_title'] = 'Giỏ hàng của bạn';
		return view('account::my-cart')->with($this->data);
	}

	public function shippingStep(Request $request)
	{
		$this->data['_title'] = 'Thông tin giao hàng';
		return view('cart::shipping')->with($this->data);
	}

	public function getCheckout(Request $request)
	{
		$this->data['_title'] = 'Đặt hàng';
		if ($request->submit) {
			$request->session()->set('customername', $request->name);
			$request->session()->set('customeraddress', $request->address);
			$request->session()->set('customerphone', $request->phone);
		}
		return view('cart::list-cart')->with($this->data);
	}
	
}