<?php 
namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Session;
use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

class DashboardController extends BaseController{

	public function show(){

		
		$orders = Order::all()->count();

		$products = Product::all()->count();

		$users = User::all()->count();

		$payments = (Payment::all()->sum('amount'))/100;

		return view("/admin/dashboard",compact('orders','products','users','payments'));
		
	}

	public function get(){

		Request::refresh();
		$data = Request::old('post','product');
		var_dump($data);
		// if(Request::has('post')){
		// 	$request = Request::get('post');
		// 	var_dump($request->product);
		// }else{
		// 	var_dump("posting does not exist");
		// }
		
	}
}
?>