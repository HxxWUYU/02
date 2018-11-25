<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Request;
use App\Models\Product;

class ProductController extends BaseController{

	public function show($id){

		$token = CSRFToken::_token();
		$product = Product::where('id',$id)->first();
		return view('product',compact('token','product'));
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



}
?>