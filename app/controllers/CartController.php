<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Mail;
use App\Classes\Request;
use App\Models\Product;

class CartController extends BaseController{

	public function addItem(){
		if(Request::has('post')){
			$request = Request::get('post');
			if(CSRFToken::verifyCSRFToken($request->token,false)){
				if(!$request->product_id){
					throw new \Exception('Malicious Activity');
				}
				Cart::add($request);
				echo json_encode(['success'=>'Product Added To Cart']);
				exit;
			}
		}
	}
}
?>