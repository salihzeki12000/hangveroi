<?php

namespace App\Http\Controllers;

use Html;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderNote;

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
}
