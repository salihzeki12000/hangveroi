<?php

namespace App\Http\Controllers;

use Html;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNote;
use App\Models\Product;

class AdminOrdersController extends Controller
{
	public function getOrders()
	{
		$this->data['_header'] =    Html::style('assets/css/plugins/datatables.bootstrap.min.css').
        Html::script('assets/js/plugins/jquery.datatables.min.js').
        Html::script('assets/js/plugins/datatables.bootstrap.min.js').

        Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
        Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js');

        $this->data['articleItems'] = Order::withTrashed()->orderBy('updated_at', 'desc')->get();

        $title = trans('order.orders');
        $this->data['_title'] = $title;
        $this->data['_nav_title'] = trans('order.orders');
        return view('admin.order.list')->with($this->data);
    }

    public function viewOrder(Request $request)
    {
        $this->data['_header'] =    Html::style('assets/css/plugins/select2.min.css').
        Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.css').
        Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css').
        Html::style('assets/css/plugins/bootstrap-material-datetimepicker.css').
        Html::style('assets/css/plugins/mediaelementplayer.css').
        Html::style('assets/css/plugins/animate.min.css').
        Html::style('assets/css/plugins/dropzone.css').
        Html::style('plugins/uploadify/uploadify.css').
        Html::style('plugins/froala_editor/css/froala_editor.min.css').

        Html::script('assets/js/plugins/jquery.datatables.min.js').
        Html::script('assets/js/plugins/datatables.bootstrap.min.js').
        Html::script('assets/js/plugins/jquery.knob.js').
        Html::script('assets/js/plugins/ion.rangeSlider.min.js').
        Html::script('assets/js/plugins/bootstrap-material-datetimepicker.js').
        Html::script('assets/js/plugins/jquery.mask.min.js').
        Html::script('assets/js/plugins/select2.full.min.js').
        Html::script('assets/js/plugins/nouislider.min.js').
        Html::script('plugins/uploadify/jquery.uploadify.min.js').
        Html::script('plugins/froala_editor/js/froala_editor.min.js').
        Html::script('assets/js/plugins/dropzone.js').
        Html::script('assets/js/plugins/jquery.validate.min.js').

        Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
        Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js').

        Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
        Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');

        $orderItem = Order::withTrashed()->where('id', $request->segment(4))->first();
        $orderDetails = OrderDetail::where('order_id', $request->segment(4))->get();

        $this->data['articleItem'] = $orderItem;
        $this->data['orderItemDetails'] = $orderDetails;

        $this->data['_title'] = 'View order';
        $this->data['_nav_title'] = 'Order detail of <b>' . $orderItem->cus_name . '</b>' ;
        return view('admin.order.detail')->with($this->data);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $orderItem = Order::withTrashed()->where('id', $id)->first();
        $orderItem->status = $request->status;
        if ($orderItem->save()) {
            return response()->json([
                'error' => false
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }

    public function doUpdateOrder(Request $request)
    {
        date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
        $id = $request->segment(4);
        $inputs = $request->all();
        $order = Order::find($id);
        $oldStatus = $order->status;
        $orderNote = new OrderNote();
        if ($oldStatus != $inputs['status']) {
            $order->status = $inputs['status'];
            $order->save();
            $orderNote->order_id = $order->id;
            $orderNote->note = ($inputs['status'] == 'cancel') ? "Changed from <b>" . $oldStatus . "</b> to <b>" . $order->status . "</b>: " . $inputs['note'] : "Changed from <b>" . $oldStatus . "</b> to <b>" . $order->status . "</b>";
        } else {
            $orderNote->order_id = $order->id;
            $orderNote->note = $inputs['note'];
        }
        $orderNote->save();
        return redirect()->to('/admin/orders')->with('msg', 'Updated!');
    }

    public function printBill(Request $request)
    {
        $this->data['articleItem'] = Order::withTrashed()->where('id', $request->id)->first();
        return view('admin.order.bill')->with($this->data);
    }

    public function editOrder(Request $request)
    {
        $this->data['_header'] =    Html::style('assets/css/plugins/select2.min.css').
        Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.css').
        Html::style('assets/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css').
        Html::style('assets/css/plugins/bootstrap-material-datetimepicker.css').
        Html::style('assets/css/plugins/mediaelementplayer.css').
        Html::style('assets/css/plugins/animate.min.css').
        Html::style('assets/css/plugins/dropzone.css').
        Html::style('plugins/uploadify/uploadify.css').
        Html::style('plugins/froala_editor/css/froala_editor.min.css').

        Html::script('assets/js/plugins/jquery.datatables.min.js').
        Html::script('assets/js/plugins/datatables.bootstrap.min.js').
        Html::script('assets/js/plugins/jquery.knob.js').
        Html::script('assets/js/plugins/ion.rangeSlider.min.js').
        Html::script('assets/js/plugins/bootstrap-material-datetimepicker.js').
        Html::script('assets/js/plugins/jquery.mask.min.js').
        Html::script('assets/js/plugins/select2.full.min.js').
        Html::script('assets/js/plugins/nouislider.min.js').
        Html::script('plugins/uploadify/jquery.uploadify.min.js').
        Html::script('plugins/froala_editor/js/froala_editor.min.js').
        Html::script('assets/js/plugins/dropzone.js').
        Html::script('assets/js/plugins/jquery.validate.min.js').

        Html::style('plugins/bootstrap-dialog/css/bootstrap-dialog.min.css').
        Html::script('plugins/bootstrap-dialog/js/bootstrap-dialog.min.js').

        Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
        Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');

        $orderItem = Order::withTrashed()->where('id', $request->segment(4))->first();
        $orderDetails = OrderDetail::where('order_id', $request->segment(4))->get();
        $productItems = Product::orderBy('name', 'ASC')->get();

        $this->data['articleItem'] = $orderItem;
        $this->data['orderItemDetails'] = $orderDetails;
        $this->data['productItems'] = $productItems;

        $this->data['_title'] = 'Edit order';
        $this->data['_nav_title'] = 'Edit order of <b>' . $orderItem->cus_name . '</b>' ;
        return view('admin.order.edit')->with($this->data);
    }

    public function doEditOrder(Request $request)
    {
        date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
        $order = Order::find($request->id);
        $order->cus_name = $request->cus_name;
        $order->cus_email = $request->cus_email;
        $order->cus_phone = $request->cus_phone;
        $order->cus_address = $request->cus_address;
        $order->save();

        $orderNote = new OrderNote();
        $orderNote->order_id = $order->id;
        $orderNote->note = "Update informations of customer";
        $orderNote->save();

        return redirect()->to('/admin/orders/view/' . $request->id)->with('msg', 'Updated!');
    }

    public function addOrderItem(Request $request)
    {
        date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
        $orderPrice = 0;
        $orderQty = 0;
        $arrayProductId = array();
        $orderItem = Order::find($request->orderId);
        $orderDetailItems = OrderDetail::where('order_id', $orderItem->id)->get();
        $productItem = Product::find($request->productId);
        $orderNote = new OrderNote();
        foreach ($orderDetailItems as $orderDetailItem) {
            $arrayProductId[] = $orderDetailItem->product_id;
        }
        if (in_array($productItem->id, $arrayProductId)) {
            $orderDetail = OrderDetail::where('product_id', $request->productId)->first();
            $orderDetail->product_qty = $orderDetail->product_qty + $request->qty;
            $orderDetail->save();

            $orderItems = OrderDetail::where('order_id', $orderItem->id)->get();
            foreach($orderItems as $item) {
                $orderPrice += $item->product_price * $item->product_qty;
                $orderQty += $item->product_qty;
            }
            $orderItem->total_price = number_format($orderPrice);
            $orderItem->qty = $orderQty;
            $orderItem->save();
            $orderNote->order_id = $orderItem->id;
            $orderNote->note = "Update qty of product " . $productItem->name;
        } else {
            $orderDetail = new OrderDetail();
            $orderDetail->product_id = $productItem->id;
            $orderDetail->product_name = $productItem->name;
            $orderDetail->product_price = $productItem->price;
            $orderDetail->product_qty = $request->qty;
            $orderDetail->order_id = $orderItem->id;
            $orderDetail->save();

            $orderItems = OrderDetail::where('order_id', $orderItem->id)->get();
            foreach($orderItems as $item) {
                $orderPrice += $item->product_price * $item->product_qty;
                $orderQty += $item->product_qty;
            }
            $orderItem->total_price = number_format($orderPrice);
            $orderItem->qty = $orderQty;
            $orderItem->save();
            $orderNote->order_id = $orderItem->id;
            $orderNote->note = "Added " . $request->qty ." ". $productItem->name . " to this order";
        }
        $orderNote->save();
        $data = ['status' => true];
        return response()->json($data);
    }

    public function updateOrderItem(Request $request)
    {
        date_default_timezone_set( 'Asia/Ho_Chi_Minh' );
        $orderItem = OrderDetail::find($request->id);
        $orderPrice = 0;
        $orderQty = 0;
        $orderId = $orderItem->order_id;
        $order = Order::find($orderId);
        if ($request->qty != 0) {
            $orderItem->product_qty = $request->qty;
            $orderItem->save();

            $orderItems = OrderDetail::where('order_id', $orderId)->get();
            foreach($orderItems as $item) {
                $orderPrice += $item->product_price * $item->product_qty;
                $orderQty += $item->product_qty;
            }
            $order->total_price = number_format($orderPrice);
            $order->qty = $orderQty;
            $order->save();
        } else {
            $orderItem->forceDelete();
            $orderItems = OrderDetail::where('order_id', $orderId)->get();
            if (count($orderItems) == 0) {
                $order->forceDelete();
            } else {
                foreach($orderItems as $item) {
                    $orderPrice += $item->product_price * $item->product_qty;
                    $orderQty += $item->product_qty;
                }
                $order->total_price = number_format($orderPrice);
                $order->qty = $orderQty;
                $order->save();
            }
        }
        $orderNote = new OrderNote();
        $orderNote->order_id = $order->id;
        $orderNote->note = "Update quantity order item";
        $orderNote->save();

        $data = ['status' => true];

        return response()->json($data);
    }
}
