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
use App\Models\Setting;
use App\Models\OrderNote;
use Cart;
use Redirect;
use Auth;
use Session;
use Mail;
use URL;

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
				'id' 				=> $id, 
				'name' 				=> $product->name,
				'price' 			=> $product->hasPromotion() ? $product->getPromotion->money_has_discount : $product->price,
				'qty' 				=> 1,
				'options'	=>array(
					'image' => Base::get_upload_url($product->getImage->filename),
					'slug' 	=> $product->slug,
					'category' => $product->getProductType->name,
					'price_real' => $product->price,
					'discount' => $product->hasPromotion() ? $product->getPromotion->discount : 0,
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

			$productItems = Product::orderByRaw('RAND()')->paginate(12);

			$this->data['productItems'] = $productItems;
			$this->data['_title'] = 'Đặt hàng thành công!';
			$this->data['_description'] = 'Quý khách đã đặt hàng thành công trên website Ohangveroi.com. Cám ơn quý khách đã mua hàng của chúng tôi. Quý khách có thể liên hệ 0969 292 449 trong trường hợp cần thiết';
			return view('cart::success')->with($this->data);
		}
	}

	public function doOrder(Request $request)
	{
		date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
		if ($request->submit) {
			$order_item = new Order();
			if (Auth::check()) {
				$order_item->user_id = Auth::user()->id;	
			}
			$order_item->cus_name = $request->session()->get('customername');
			$order_item->cus_phone = $request->session()->get('customerphone');
			$order_item->cus_address = $request->session()->get('customeraddress');
			$order_item->cus_email = $request->session()->get('customeremail');
			$order_item->note = $request->get('note_order');
			if ((Auth::check() && Auth::user()->id != 1) && Setting::where('key', 'first_customers')->first()["value"] == 1) {
				$total = str_replace(",", "", Cart::subtotal());
				if ($total < 100000)
				{
					$total += 20000;
				}
				$totalDown10 = $total * 0.1;
				$finalTotal = $total - $totalDown10;
				$finalTotal = number_format($finalTotal);
				$isFirstPromotion = true;
			} else {
				$finalTotal = Cart::subtotal();
				$isFirstPromotion = false;
			}
			$order_item->total_price = $finalTotal;
			$order_item->qty = Cart::count();
			if($order_item->save()) {
				if ($isFirstPromotion){
					$orderNote = new OrderNote();
					$orderNote->order_id = $order_item->id;
					$orderNote->note = "Order has promotion campaign -10%";
					$orderNote->save();
				}
				foreach(Cart::content() as $item) {
					$order_detail_item = new OrderDetail();
					$order_detail_item->product_id = $item->id;
					$order_detail_item->product_name = $item->name;
					$order_detail_item->product_price = $item->price;
					$order_detail_item->product_qty = $item->qty;
					$order_detail_item->order_id = $order_item->id;
					$order_detail_item->save();

					$productUpdate = Product::find($item->id);
					$unitsOnOrder = $productUpdate->units_on_order - $item->qty;
					if ($unitsOnOrder < 0) {
						$unitsOnOrder = 0;
					}
					$productUpdate->units_on_order = $unitsOnOrder;
					$productUpdate->save();
				}
				$data = array(
					'carts' => Cart::content(),
					'cart_total_price' => Cart::subtotal(),
					'cus_name' => $request->session()->get('customername'),
					'cus_phone' => $request->session()->get('customerphone'),
					'cus_address' => $request->session()->get('customeraddress'),
					'cus_email' => $request->session()->get('customeremail'),
					'order_id' => $order_item->id
				);
				// send to Admin
				Mail::send('emails.new_order', $data, function ($message) use ($data) {
					$message->from('info@ohangveroi.com', 'Ohangveroi.com')
					->to('thebaoit@gmail.com', 'Nguyen The Bao')
					->subject('[NEW ORDER] ' . $data['cus_name'] . ' - ' . $data['cus_phone']);
				});
                // send to Customer
				if ($request->session()->get('customeremail') != "") {
					Mail::send('emails.new_order_customer', $data, function ($message) use ($data) {
						$message->from('info@ohangveroi.com', 'Ohangveroi.com')
						->to($data['cus_email'], $data['cus_name'])
						->subject('Xác nhận đơn hàng #' . $data['order_id']);
					});
				}
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
			$request->session()->set('customeremail', $request->email);
		}
		return view('cart::list-cart')->with($this->data);
	}

	public function removeItem($rowId)
	{
		Cart::remove($rowId);
		return redirect(URL::to('cart/checkout/list'));
	}
	
}