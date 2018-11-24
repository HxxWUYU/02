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
		


		$products = Product::where('featured',1)->inRandomOrder()->limit(5)->get();

		echo json_encode(['featured'=>$products]);

        // echo json_encode(['featured' => $products]);
	}

	public function getProducts(){

		$products = Product::where('featured',0)->skip(0)->take(8)->get();
		//limit 0 8
		echo json_encode(['products'=>$products]);
	}
}
?>