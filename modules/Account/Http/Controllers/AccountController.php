<?php namespace Modules\Account\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\User;
use Html;
use Hash;
use Auth;
use URL;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class AccountController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$this->data['_title'] = 'Tài khoản của ' . Auth::user()->name;
		return view('account::index')->with($this->data);
	}

	public function editAccount(Request $request)
	{
		$this->data['_title'] = 'Tài khoản của tôi | Ohangveroi.com';
		$inputs = $request->all();

		if (isset($inputs['submit'])) {
			$user = User::find(Auth::user()->id);
			$user->name = $inputs['username'];
			$user->phone = $inputs['phone'];
			$user->address = $inputs['address'];
			if ($user->save()) {
				return redirect()->to('/account/edit')->with('msg', 'Cập nhật tài khoản thành công!');
			}
		}

		return view('account::edit_account')->with($this->data);
	}

	public function managedOrders()
	{
		$this->data['_title'] = 'Đơn hàng của tôi | Ohangveroi.com';
		$orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(20);
		$this->data['orders'] = $orders;
		return view('account::managed_orders')->with($this->data);
	}

	public function orderDetail(Request $request)
	{
		$this->data['_title'] = 'Đơn hàng của tôi | Ohangveroi.com';
		$this->data['order'] = Order::where('id', $request->segment(4))->where('user_id', Auth::user()->id)->first();
		return view('account::order_detail')->with($this->data);
	}

	public function login()
	{
		$request = new Request();
		$this->data['_header'] = 
		Html::script("https://www.google.com/recaptcha/api.js").
		Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
		Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');
		$this->data['_title'] = 'Đăng nhập';
		if(Auth::check()) {
			return redirect()->to('/');
		}
		return view('account::login')->with($this->data);
	}

	public function dologin(Request $request)
	{
		$inputs = $request->all();
		if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
			return redirect()->back();
		}
	}

	public function register()
	{
		$this->data['_header'] = 
		Html::script("https://www.google.com/recaptcha/api.js").
		Html::style('plugins/bootstrap-select/css/bootstrap-select.min.css').
		Html::script('plugins/bootstrap-select/js/bootstrap-select.min.js');
		$this->data['_title'] = 'Đăng kí tài khoản';
		$this->data['cityItems'] = City::orderBy('id', 'ASC')->get();
		$this->data['districtItems'] = District::where('city_id', 79)->orderBy('name', 'ASC')->get();
		return view('account::register')->with($this->data);
	}

	public function doregister(Request $request)
	{
		$inputs = $request->all();
		$userItem = new User();
		$userItem->name = $inputs['name'];
		$userItem->email = $inputs['email'];
		$userItem->type = 3;
		$userItem->password = Hash::make($inputs['password']);
		$userItem->phone = $inputs['phone'];
		// $userItem->city_id = $inputs['city'];
		// $userItem->district_id = $inputs['district'];
		$userItem->address = $inputs['address'];
		if ($userItem->save()) {
			return redirect()->to('account/login');
		} else {
			return view('account::register');
		}
		// if($userItem->save())
		// {
		// 	$data_email = array(
		// 		'email' => $userItem->email,
		// 		);

		// 	Mail::send('modules.account.emails.register-template', $data_email, function($message) use ($data_email)
		// 	{
		// 		$subject = "HDLSHLDS";
		// 		$message->to($data_email['email'])->subject($subject);
		// 	});
		// }
	}

	public function mycart(Request $request)
	{
		if(!Auth::check()) {
			return redirect()->to('404');
		} else { 
			$this->data['_title'] = 'Giỏ hàng của bạn';
			return view('account::my-cart')->with($this->data);
		}
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->flush();
		return redirect()->to('/');
	}

	public function loginWithFacebook(Request $request)
	{
		$code = $request->get('code');
		$fb = \OAuth::consumer('Facebook');
		if ( ! is_null($code)) {
			$token = $fb->requestAccessToken($code);
			$result = json_decode($fb->request('/me'), true);

			$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			echo $message. "<br/>";
			dd($result);
		} else {
			$url = $fb->getAuthorizationUri();
			return redirect((string)$url);
		}
	}

	public function loginWithGoogle(Request $request)
	{
    // get data from request
		$code = $request->get('code');

    // get google service
		$googleService = \OAuth::consumer('Google');

    // check if code is valid

    // if code is provided get user data and sign in
		if ( ! is_null($code))
		{
        // This was a callback request from google, get the token
			$token = $googleService->requestAccessToken($code);

        // Send a request with it
			$result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

			$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			echo $message. "<br/>";

        //Var_dump
        //display whole array.
			dd($result);
		}
    // if not ask for permission first
		else
		{
        // get googleService authorization
			$url = $googleService->getAuthorizationUri();

        // return to google login url
			return redirect((string)$url);
		}
	}
	
}