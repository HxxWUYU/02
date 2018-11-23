<?php 
namespace App\Controllers;

use App\Classes\Mail;
use App\Models\Product;

class IndexController extends BaseController{

	public function show(){
		return view('home');
		// $mail = new Mail();
		// $data = [
		// 	'to' => 'derrickhuang2333@gmail.com',
		// 	'subject'=> 'Welcome to Hxx Store',
		// 	'view' => 'welcome',
		// 	'name' => 'Hxx',
		// 	'body' => "Testing email template"
		// 	];

		// if($mail->send($datas)){
		// 	echo "Email sent!";
		// }else{
		// 	echo "Email sending failed!";
		// }

	}

	public function featuredProducts(){
		$products = Product::where('featured',1)->inRandomOrder()->limt(4)->get();

		echo json_encode(['featured'=>$products]]);
	}
}
?>