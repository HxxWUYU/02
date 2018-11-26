<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Mail;
use App\Classes\Request;
use App\Classes\Session;
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

	public function show(){
		return view('cart');
	}

	public function getCartItems(){

		try{
			$result = [];

		$cartTotal = 0;

		if(!Session::has('user_cart')||count(Session::get('user_cart'))<1){
			echo json_encode(['fail'=>'No item in the cart']);
			exit;
		}else{
			$index = 0;
			foreach($_SESSION['user_cart'] as $cart_items){
				$productId = $cart_items['product_id'];
				$quantity = $cart_items['quantity'];
				$item = Product::where('id',$productId)->first();
				if(!$item){
					continue;
				}else{
					$totalPrice = $item->price*$quantity;
					$cartTotal+=$totalPrice;
					$totalPrice = number_format($totalPrice,2);
					array_push($result,[
						'id'=>$item->id,
						'name'=>$item->name,
						'image'=>$item->image_path,
						'description'=>$item->description,
						'price'=>$item->price,
						'totalPrice'=>$totalPrice,
						'quantity'=>$quantity,
						'stock'=>$item->quantity,
						'index'=>$index
					]);
					$index++;
				}
			}

			$cartTotal = number_format($cartTotal,2);
			echo json_encode(['items'=>$result,'cartTotal'=>$cartTotal]);
			exit;
		}
		}catch(\Exception $ex){
			//
		}
	}

	public function updateQty(){
		if(Request::has('post')){
			$request = Request::get('post');
			if(!$request->product_id){
				throw new \Exception('Malicious Activity');
			}		

			$index=0;
			$quantity='';
			foreach ($_SESSION['user_cart'] as $cart_items) {
					$index++;
					foreach ($cart_items as $key => $value) {
						if($key=='product_id' && $value=$request->product_id){
							switch ($request->operator) {
								case '+':
									$quantity = $cart_items['quantity']+1;
									break;
								case '-':
									$quantity = $cart_items['quantity']-1;
									if($quantity<1){
										$quantity=1;
									}
									break;
								
							}
							array_splice($_SESSION['user_cart'],$index-1,1,
							array(['product_id'=>$request->product_id,
							'quantity'=>$quantity
							]));
						}
					}
			}	
		}
	}
}
?>