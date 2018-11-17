<?php 
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Classes\Session;

class DashboardController extends BaseController{

	public function show(){

		Session::add("admin","You are welcome");

		if(Session::has('admin')){
			$msg = Session::get('admin');
		}else{
			$msg = 'Not defined';
		}
		return view("/admin/dashboard",['admin'=>$msg]);
		
	}
}
?>