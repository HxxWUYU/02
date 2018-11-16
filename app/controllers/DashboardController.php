<?php 
namespace App\Controllers;

//use App\Controllers\BaseController;

class DashboardController extends BaseController{

	public function show(){

		return view('/admin/dashboard');
	}
}


?>