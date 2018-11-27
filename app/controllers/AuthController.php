<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Models\User;

class AuthController extends BaseController{

	public function __construct(){
		if(isAuthenticated()){
			Redirect::to('/02/public/');
		}
	}

	public function showRegisterForm(){

		return view('register');
	}

	public function showLoginForm(){
		return view('login');
	}

	public function register(){
		if(Request::has('post')){
			$request = Request::get('post');
			if(CSRFToken::verifyCSRFToken($request->token)){
				$rules=[
					'username'=>['required'=>true,'maxLength'=>20,'mixed'=>true,'unique'=>'users','minLength'=>2 ],
					'email'=>['required'=>true,'email'=>true,'unique'=>'users'],
					'password'=>['required'=>true,'minLength'=>6],
					'fullname'=>['required'=>true,'minLength'=>6,'maxLength'=>40,'string'=>true],
					'address'=>['required'=>true,'minLength'=>6,'maxLength'=>500,'mixed'=>true]

				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				if($validate->hasError()){
					$errors = $validate->getErrorMessages();
					return view('register',['errors'=>$errors]);
				}else{
					User::create([
						'username'=>$request->username,
						'email'=>$request->email,
						'password'=>password_hash($request->password,PASSWORD_BCRYPT),
						'fullname'=>$request->fullname,
						'address'=>$request->address,
						'role'=>'user'
					]);

					Request::refresh();
					return view('register',['message'=>'Account created,please login.']);
				}
			}else{
				throw new \Exception('Token Mismatch');
			}
		}else{
			return null;
		}
	}

	public function login(){
		if(Request::has('post')){
			$request = Request::get('post');
			if(CSRFToken::verifyCSRFToken($request->token)){
				$rules=[
					'username'=>['required'=>true],
					
					'password'=>['required'=>true]
					
				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				if($validate->hasError()){

					$errors = $validate->getErrorMessages();
					return view('login',['errors'=>$errors]);
				}else{
					
					//Check
					$user = User::where('username',$request->username)->orWhere('email',$request->username)->first();

					if($user){
						if(!password_verify($request->password,$user->password)){
							Session::add('error',"Whoops!We can't find a match!");
							$errors = "Whoops!We can't find a match!";
							return view('login');
						}else{
							Session::add('SESSION_USER_ID',$user->id);
							Session::add('SESSION_USER_NAME',$user->username);
							Redirect::to('/02/public/');
						}
					}else{
						Session::add('error','User not found, please try again');
						
						return view('login');
					}

				}
			}else{
				throw new \Exception('Token Mismatch');
			}
		}else{
			return null;
		}
	}

	public function logout(){
		if(isAuthenticated()){
			Session::remove('SESSION_USER_ID');
			Session::remove('SESSION_USER_NAME');

		}
		Redirect::to('/02/public/');
	}
	
}
?>