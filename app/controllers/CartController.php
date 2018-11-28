<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Cart;
use App\Classes\Mail;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Stripe\Charge;
use Stripe\Customer;

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
			Session::add('cartTotal',$cartTotal);
			echo json_encode(['items'=>$result,'cartTotal'=>$cartTotal,'authenticated'=>isAuthenticated(),'amount'=>convertToCents($cartTotal)]);
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
						if($key=='product_id' && $value==$request->product_id){
							switch ($request->operator){
                            case '+':
                                $quantity = $cart_items['quantity'] + 1;
                                break;
                            case '-':
                                $quantity = $cart_items['quantity'] - 1;
                                if($quantity < 1){
                                    $quantity = 1;
                                }
                                break;
                      		}
							 array_splice($_SESSION['user_cart'], $index - 1, 1, array(
                            [
                                'product_id' => $request->product_id,
                                'quantity' => $quantity
                            ]
                        ));
						}
					}
			}	
		}
	}

	public function removeItem(){
		
		if(Request::has('post')){
			$request = Request::get('post');

			if($request->item_index===''){
				throw new \Exception('Malicious Activity');
			}else{
				//remove item

				Cart::removeItem($request->item_index);

				echo json_encode(['success'=>'Product Removed From Cart!']);
				exit;
			}
		}
	}

	public function clearCart(){
		Cart::clear();
		echo json_encode(['success'=>'Cart Cleared Successfuly!']);
		exit;
	}

	public function checkout(){
		if(Request::has('post')){
			$result['product']=array();
			$result['order_no']=array();
			$result['total']=array();

			$request = Request::get('post');
			$token = $request->stripeToken;
			$mail = $request->stripeEmail;
			try{
				$customer = Customer::create([
                  'email' => $email,
                  'source' => $token
              ]);
				$amount = convertToCents(Session::get('cartTotal'));
				$charge = Charge::create([
					'customer'=>$customer->id,
					'amount'=>$amount,
					'description'=>user()->fullname.' purchase',
					'currency'=>'usd'
				]);

				$order_id = strtoupper(uniqid());
				
			foreach($_SESSION['user_cart'] as $cart_items){
				$productId = $cart_items['product_id'];
				$quantity = $cart_items['quantity'];
				$item = Product::where('id',$productId)->first();
				if(!$item){
					continue;
				}else{
					$totalPrice = $item->price*$quantity;
					$totalPrice = number_format($totalPrice,2);

					Order::create([
						'user_id'=>user()->id,
						'product_id'=>$productId,
						'unit_price'=>$item->price,
						'status'=>'Pending',
						'quantity'=>$quantity,
						'total'=>$totalPrice,
						'order_no'=>$order_id
					]);

					$item->quantity = $item->quantity-$quantity;
					$item->save();

					array_push($result['product'],[
						'name'=>$item->name,	
						'price'=>$item->price,
						'totalPrice'=>$totalPrice,
						'quantity'=>$quantity
						
					]);
					
				}
			}

			Payment::create([
				'user_id'=>user()->id,
				'amount'=>$charge->amount,
				'status'=>$charge->status,
				'order_no'=>$order_id
			]);

			$result["order_no"] = $order_id;

			$result['total']=Session::get('cartTotal');
$data = [
				'to' => user()->email,
				'subject'=> 'Order Confirmation',
				'view' => 'purchase',
				'name' => user()->fullname,
				'body' => $result
			];

			(new Mail())->send($data);

			// echo json_encode(['customer'=>$customer]);
			// exit;

			}catch(\Exception $ex){
				echo $ex->getMessage();
			}

			Cart::clear();
			
			echo json_encode(['success'=>'Thank you for you purchase!']);
			ob_end_flush();
			while (@ob_end_clean()) {  
    			// do nothing   
	}
			exit;
		}
		// echo json_encode(['success'=>'Yes!!!']);
	}
}
?>