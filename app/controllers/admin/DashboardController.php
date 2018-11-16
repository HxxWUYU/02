<?php 
namespace App\Admin\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController{

	public function show(){
		view("/admin/dashboard");
		

	}
}
?>