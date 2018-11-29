<?php 
namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Session;
use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Capsule\Manager;

class DashboardController extends BaseController{

	public function show(){

		
		$orders = Order::all()->count();

		$products = Product::all()->count();

		$users = User::all()->count();

		$payments = (Payment::all()->sum('amount'))/100;

		return view("/admin/dashboard",compact('orders','products','users','payments'));
		
	}

	public function getChartData(){

		$revenue = Manager::table('payments')->select(
			Manger::raw('sum(amount) as `amount`'),
			Manger::raw('DATE_FORMAT(created_at,"%m-%Y") new_date'),
			Manger::raw('YEAR(created_at) year, Month(created_at) month')

		)->groupby('year','month')->get();

		$orders = Manager::table('orders')->select(
			Manger::raw('count(id) as `count`'),
			Manger::raw('DATE_FORMAT(created_at,"%m-%Y") new_date'),
			Manger::raw('YEAR(created_at) year, Month(created_at) month')

		)->groupby('year','month')->get();

		echo json_encode([
			'revenues'=>$revenue,
			'orders'=>$orders
		]);
		
	}
}
?>