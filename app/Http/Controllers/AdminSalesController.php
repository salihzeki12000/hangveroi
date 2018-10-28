<?php

namespace App\Http\Controllers;

use Html;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductType;
use Cart;
use Redirect;
use Auth;
use Session;
use URL;

class AdminSalesController extends Controller
{
	public function index(Request $request)
	{
		date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
		Html::script('assets/js/plugins/jquery.datatables.min.js').
		Html::script('assets/js/plugins/datatables.bootstrap.min.js').

		Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
		Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

		if ($request->has('_token')) {
			$order = new Order();
			$order->cus_name = $request->cus_name;
			$order->cus_phone = $request->cus_phone;
			$order->cus_address = $request->cus_address;
			$order->note = $request->order_note;
			$order->total_price = Cart::subtotal();
			$order->qty = Cart::count();
			if($order->save()) {
				foreach(Cart::content() as $item) {
					$order_detail_item = new OrderDetail();
					$order_detail_item->product_id = $item->id;
					$order_detail_item->product_name = $item->name;
					$order_detail_item->product_price = $item->price;
					$order_detail_item->product_qty = $item->qty;
					$order_detail_item->order_id = $order->id;
					$order_detail_item->save();

					$productUpdate = Product::find($item->id);
					$unitsOnOrder = $productUpdate->units_on_order - $item->qty;
					if ($unitsOnOrder < 0) {
						$unitsOnOrder = 0;
					}
					$productUpdate->units_on_order = $unitsOnOrder;
					$productUpdate->save();
				}
			}
			Cart::destroy();
			$link = "<script>window.open('" . URL::to('admin/orders/print/' . $order->id . '?feeShip=' . $request->cus_feeship) . "', 'windowChild', 'width=700, height=700');</script>";
			echo $link;
		}
		$this->data['categories'] = ProductType::where('parent', 0)->get();
		$products = Product::orderBy('updated_at', 'desc');
		if (isset($request->cmdCategory) && $request->cmdCategory != 0) {
			$productTypes = ProductType::where('id', $request->cmdCategory)->get();
			if ($productTypes->count()) {
				$producTypeIds = array();
				foreach($productTypes as $productType) {
					if ($productType->parent != 0) {
						$producTypeIds[] = $productType->id;	
					} else {
						$productSubs = ProductType::where('parent', $productType->id)->get();
						foreach ($productSubs as $productSub) {
							$producTypeIds[] = $productSub->id;	
						}
						$producTypeIds[] = $productType->id;
					}
				}
				$products = $products->whereIn('product_type', $producTypeIds);
			}	
		}
		if (isset($request->txtName) && $request->txtName != '') {
			$products = $products->where('name', 'LIKE', '%'.$request->txtName.'%');	
		}
		$this->data['articleItems'] = $products->get();

		$title = "Sales";
		$this->data['_title'] = $title;
		$this->data['_nav_title'] = $title;
		return view('admin.sales.sales')->with($this->data);
	}
}
