<?php 
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Classes\Request;
use App\Classes\ValidateRequest;

class AuthController extends BaseController{

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
					'username'=>['required'=>true,'maxLength'=>20,'mixed'=>true,'unique'=>'users'],
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
				}
			}
		}
	}

	public function login(){
	}
}
?>