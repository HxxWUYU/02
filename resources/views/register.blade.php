@extends('layouts.app')
@section('title',"Register Free Account") 
@section('data-page-id','auth')

@section('content')
	<div class="auth" id="auth">

		<section class="register_form">
			<div class="row">
				<div class="small-12 meidum-7 meidum-centered">
					<h2 class="text-center">Create Account</h2>
					@include('includes.message')
					<form id="registerForm" action="/02/public/register" method="post">
						<input type="text" name="fullname" placeholder="Your name" value="{{\App\Classes\Request::old('post','fullname')}}" minlength="6" maxlength="40" required>

						<input type="email" name="email" placeholder="Your Email Address" value="{{\App\Classes\Request::old('post','email')}}" required>

						<input type="text" name="username" placeholder="Your User Name" value="{{\App\Classes\Request::old('post','username')}}" minlength="2" maxlength="20" required>

						<input type="password" name="password" placeholder="Your Password" minlength="6" required>

						<textarea name="address" placeholder="Your Address" minlength="6" required>{{\App\Classes\Request::old('post','address')}}</textarea>

						<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
						<button type="submit" class="button float-right">Register</button>
					</form>
					<p>Already Registered?<a href="/02/public/login"> Login Here</a></p>
				</div>
			</div>
		</section>
		
	</div>

	
@stop