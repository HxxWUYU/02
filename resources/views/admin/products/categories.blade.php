@extends('admin.layout.base')
@section('title','Product Categories')

@section('content')

 <div class="category">
 	<div class="row expanded">
 		<h2>Product Categories</h2>

 		
 	</div>
 	<div class="row expanded">

 		<div class="small-12 medium-6 column">
 			<form action="" method="post">
 				<div class='input-group'>
 					<input type="text" class="input-group-field" placeholder="Search by name">
 					<div class="input-group-button">
 						<input type="submit" class="button" value="Search">
 					</div>
 				</div>
 			</form>
 		</div>

 		<div class="small-12 medium-5 end column">
 			<form action="/02/public/admin/product/categories" method="post">
 				<div class='input-group'>
 					<input type="text" class="input-group-field" name="name" placeholder="Category name">
 					<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
 					<div class="input-group-button">
 						<input type="submit" class="button" value="Create">
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>

@endsection