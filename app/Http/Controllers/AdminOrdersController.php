<?php

namespace App\Http\Controllers;

use Html;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Order;

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
}
