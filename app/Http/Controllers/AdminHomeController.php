<?php

namespace App\Http\Controllers;

use Html;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\Product;
use App\User;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['_header'] = Html::style('assets/css/plugins/simple-line-icons.css').Html::style('assets/css/plugins/animate.min.css').Html::style('assets/css/plugins/fullcalendar.min.css').Html::script('assets/js/plugins/fullcalendar.min.js').Html::script('assets/js/plugins/jquery.vmap.min.js').Html::script('assets/js/plugins/maps/jquery.vmap.world.js').Html::script('assets/js/plugins/jquery.vmap.sampledata.js').Html::script('assets/js/plugins/chart.min.js');
        $this->data['totalProductNearOutOfStock'] = Product::where('units_on_order', '<', 5)->count();
        $this->data['totalUser'] = User::all()->count();
        $this->data['totalOrder'] = Order::where('status', 'new')->count();

        $order = new Order();
        $this->data['totalOrder1'] = $order->getTotalOrderByMonth('01');
        $this->data['totalOrder2'] = $order->getTotalOrderByMonth('02');
        $this->data['totalOrder3'] = $order->getTotalOrderByMonth('03');
        $this->data['totalOrder4'] = $order->getTotalOrderByMonth('04');
        $this->data['totalOrder5'] = $order->getTotalOrderByMonth('05');
        $this->data['totalOrder6'] = $order->getTotalOrderByMonth('06');
        $this->data['totalOrder7'] = $order->getTotalOrderByMonth('07');
        $this->data['totalOrder8'] = $order->getTotalOrderByMonth('08');
        $this->data['totalOrder9'] = $order->getTotalOrderByMonth('09');
        $this->data['totalOrder10'] = $order->getTotalOrderByMonth('10');
        $this->data['totalOrder11'] = $order->getTotalOrderByMonth('11');
        $this->data['totalOrder12'] = $order->getTotalOrderByMonth('12');

        $this->data['totalMoneyCurrentMonth'] = $order->getTotalMoneyByMonth(date('m'));

        $this->data['totalOrderByNew'] = $order->getTotalOrderStatus(date('m'), 'new');
        $this->data['totalOrderByShipping'] = $order->getTotalOrderStatus(date('m'), 'shipping');
        $this->data['totalOrderByCancel'] = $order->getTotalOrderStatus(date('m'), 'cancel');
        $this->data['totalOrderBySuccess'] = $order->getTotalOrderStatus(date('m'), 'success');

        $this->data['totalMoney'] = $order->getTotalMoneyByMonth(0);
        return view('admin.home')->with($this->data);
    }

    public function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }

    public function executedSql(Request $request)
    {
        if ($request->text) {
            $sql = $request->text;
            $pdo = DB::connection()->getPdo();
            $query = $pdo->prepare($sql);
            $success = $query->execute();
            if ($success) {
                echo "Thất bại!";
            } else {
                echo "Thất bại.";
            }
        }
        return view('admin.executed');
    }
}
