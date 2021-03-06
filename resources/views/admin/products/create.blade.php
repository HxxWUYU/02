@extends('admin.layout.base')
@section('title','Create Product')
@section('data-page-id',"adminProduct")

@section('content')

 <div class="add-product admin_shared" >
 	<div class="grid-x grid-padding-x">
 		<div class="cell medium-11">
 			<h2>Add Inventory Item</h2><hr>
 		</div>


 		
 	</div>
 	@include('includes.message')
 	<form method="post" action="/02/public/admin/product/create" enctype="multipart/form-data">
 		<div class="small-12 medium-11">
 			<div class="grid-x grid-padding-x">
 				<div class="small-12 medium-6 cell">
 					<label>
 						Product name:
 						<input type="text" name="name" placeholder="Product name" value="{{\App\Classes\Request::old('post','name')}}">
 					</label>
 				</div>
 				<div class="small-12 medium-6 column">
 					<label>
 						Product price:
 						<input type="text" name="price" placeholder="Product price" value="{{\App\Classes\Request::old('post','price')}}">
 					</label>
 				</div>

 				<div class="small-12 medium-6 cell">
 					<label>Product Category:
 						<select name="category" id="product-category">
 							<option value="{{\App\Classes\Request::old('post','category')?:''}}">{{\App\Classes\Request::old('post','categoryname')?:'Select Category'}}</option>
 							@foreach($categories as $category)
 							<option value="{{$category->id}}">{{$category->name}}</option>
 							@endforeach
 						</select>
 						
 					</label>
 				</div>
 				<div class="small-12 medium-6 cell">

 					<label>
 						Product Subcategory:
 						<select name="subcategory" id="product-subcategory">
 							<option value="{{\App\Classes\Request::old('post','subcategory')?:''}}">{{\App\Classes\Request::old('post','subcategoryname')?:'Select Subcategory'}}</option>
 							
 						</select>
 					</label>
 				</div>

 				<div class="small-12 medium-6 cell">
 					<label>Product Quantity:
 						<select name="quantity">
 							<option value="{{\App\Classes\Request::old('post','quantity')?:''}}">{{\App\Classes\Request::old('post','quantity')?:'Select quantity'}}</option>

 							@for($i=1;$i<=50;$i++)
 								<option value="{{$i}}">{{$i}}</option>
 							@endfor
 							
 						</select>
 						
 					</label>
 				</div>
 				<div class="small-12 medium-6 cell">
 					<br>
 					<div class="input-group">
 						<span class="input-group-label">Product Image:</span>
 						<input type="file" name="productImage" class="input-group-field">
 					</div>
 				</div>

 				<div class="small-12 cell">
 					<label>Descritption:
 					<textarea name="description" placeholder="Description">{{\App\Classes\Request::old('post','description')}}</textarea>
 					</label>
 					<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
 					<input type="hidden" name="categoryname" value="">
 					<input type="hidden" name="subcategoryname" value="">
 					<button class="button alert" type="reset">Reset</button>
 					<input class="button success float-right" type="submit" value="Submit">
 				</div>
 			</div>


 		</div>
 	</form>
 
 </div>

@include('includes.delete-modal')
@endsection