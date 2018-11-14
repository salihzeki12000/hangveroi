<?php namespace Modules\Cart\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Html;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Base;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\OrderNote;
use App\Models\Province;
use App\Models\District;
use Cart;
use Redirect;
use Auth;
use Session;
use Mail;
use URL;

class CartController extends Controller {

	const MAIN_CITY_ID = 79;
	const IS_MAIN_CITY = 1;
	const DISCOUNT_5_PERCENT = 0.05;

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
			'total' => Cart::subtotal(),
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
			Session::forget('customercity');
			Session::forget('customerdistrict');

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

			$citySession = $request->session()->get('customercity');
			$districtSession = $request->session()->get('customerdistrict');

			$cityItem = Province::find($citySession);
			$districtItem = District::find($districtSession);

			$order_item->cus_name = $request->session()->get('customername');
			$order_item->cus_phone = $request->session()->get('customerphone');
			$order_item->cus_address = $request->session()->get('customeraddress');
			$order_item->cus_email = $request->session()->get('customeremail');
			$order_item->city_id = $request->session()->get('customercity');
			$order_item->district_id = $request->session()->get('customerdistrict');
			$order_item->note = $request->get('note_order');
			if ((Auth::check() && Auth::user()->id != 1) && Setting::where('key', 'first_customers')->first()["value"] == 1) {
				$isFirstPromotion = true;
			} else {
				$isFirstPromotion = false;
			}
			$orderTotal = $request->session()->get('totalWithOutShippingFormat');
			$finalTotal = $request->session()->get('totalWithShippingFormat');
			$shippingFee = $request->session()->get('shippingFeeFormat');
			$order_item->total = $finalTotal;
			$order_item->total_price = $orderTotal;
			$order_item->shipping_fee = $shippingFee;
			$order_item->qty = Cart::count();
			if($order_item->save()) {
				if ($isFirstPromotion){
					$orderNote = new OrderNote();
					$orderNote->order_id = $order_item->id;
					$orderNote->note = "Order has promotion campaign -5%";
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
					'cart_total_price' => Cart::subTotal(),
					'cart_total_price_final' => $finalTotal,
					'shipping_fee' => $request->session()->get('shippingFeeFormat'),
					'cus_name' => $request->session()->get('customername'),
					'cus_phone' => $request->session()->get('customerphone'),
					'cus_address' => $request->session()->get('customeraddress'),
					'cus_email' => $request->session()->get('customeremail'),
					'cus_city' => $request->session()->get('customercity'),
					'cus_district' => $request->session()->get('customerdistrict'),
					'cityItem' => $cityItem,
					'districtItem' => $districtItem,
					'order_id' => $order_item->id
				);
				// send to Admin
				Mail::send('emails.new_order', $data, function ($message) use ($data) {
					$message->from('info@ohangveroi.com', 'Ohangveroi.com')
					->to('thebaoit@gmail.com', 'Nguyen The Bao')
					->cc('ntkimchau0707@gmail.com', 'Kim Chau')
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
		$this->data['cities'] = Province::all();

		if (Auth::check()) {
			$this->data['currentCity'] = Auth::user()->province_id;
			$this->data['currentDistrict'] = Auth::user()->district_id;
		} else {
			$this->data['currentCity'] = 79;
			$this->data['currentDistrict'] = 760;
		}
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
			$request->session()->set('customercity', $request->city);
			$request->session()->set('customerdistrict', $request->district);
		}
		return view('cart::list-cart')->with($this->data);
	}

	public function removeItem($rowId)
	{
		Cart::remove($rowId);
		return redirect(URL::to('cart/checkout/list'));
	}

	public function searchInfo(Request $request)
	{
		$phone = str_replace(array('.', ' '), array('', ''), $request->phone);
		$orderInfo = Order::where('cus_phone', $phone)->first();
		if (count($orderInfo)) {
			return response()->json(['error' => 'false', 'info' => $orderInfo]);
		} else {
			return response()->json(['error' => 'true', 'info' => null]);
		}
	}
	
	public function calculatorFee(Request $request)
	{
		$cityItem = Province::find($request->cityId);
		$districtItem = District::find($request->districtId);
		$feeShip = 0;
		$total = 0;
		$subTotal = str_replace(",", "", Cart::subtotal());

		if ($cityItem->id == self::MAIN_CITY_ID) {
			if ($districtItem->main_city == self::IS_MAIN_CITY) {
				if ($subTotal > 100000) {
					$feeShip = 0;
				} else {
					$feeShip = 22000;
				}
			} else {
				if ($subTotal >= 200000) {
					$feeShip = 0;
				} elseif ($subTotal >= 100000 && $subTotal < 200000) {
					$feeShip = 15000;
				} else {
					$feeShip = 35000;
				}
			}
		} else {
			if ($districtItem->main_city == self::IS_MAIN_CITY) {
				if ($subTotal >= 200000) {
					$feeShip = 0;
				} else {
					$feeShip = 30000;
				}
			} else {
				if ($subTotal >= 200000) {
					$feeShip = 0;
				} else {
					$feeShip = 40000;
				}
			}
		}

		if ((Auth::check() && Auth::user()->id != 1) && Setting::where('key', 'first_customers')->first()["value"] == 1) {
			$totalDown5 = $subTotal * self::DISCOUNT_5_PERCENT;
			$subTotal = $subTotal - $totalDown5;
		}

		$total = $subTotal + $feeShip;

		$request->session()->set('shippingFeeFormat', number_format($feeShip));
		$request->session()->set('totalWithOutShippingFormat', number_format($subTotal));
		$request->session()->set('totalWithShippingFormat', number_format($total));

		return response()->json([
			'total' => Cart::subtotal(),
			'shippingFee' => $feeShip,
			'shippingFeeFormat' => number_format($feeShip),
			'totalWithShipping' => $total,
			'totalWithShippingFormat' => number_format($total),
			'error' => false
		]);
	}
}
