@extends('layouts.app')
@section('title',"Login To Your Account") 
@section('data-page-id','auth')

@section('content')
	<div class="auth" id="auth" >

		<section class="login_form">
			<div class="row">
				<div class="small-12 meidum-7 meidum-centered">
					<h2 class="text-center">Login</h2>
					@include('includes.message')
					<form id="loginForm" action="/02/public/login" method="post">
						
						<span>Username:</span>
						<input type="text" name="username" placeholder="Your User Name Or Email Address" value="{{\App\Classes\Request::old('post','username')}}" required>
						<span>Password:</span>
						<input type="password" name="password" placeholder="Your Password" required>
						<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
						
						<button type="submit" class="button float-right">Login</button>
					</form>
					<p>Not yet register?<a href="/02/public/regitser"> Register Here</a></p>
				</div>
			</div>
		</section>
		
	</div>

	
@stop