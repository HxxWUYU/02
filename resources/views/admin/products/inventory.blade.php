@extends('admin.layout.base')
@section('title','Mange Inventory')
@section('data-page-id',"adminProduct")

@section('content')

 <div class="products admin_shared">
 	<div class="grid-x">
 		<div class="cell medium-11">
 			<h2>Mange Inventory Item</h2><hr>
 		</div>		
 	</div>
 	@include('includes.message')
 	<div class="grid-x">
 		<div class="small-12 medium-11 cell">
 			<a href="/02/public/admin/product/create" class="button float-right">
 				<i class="fa fa-plus"></i>Add New Product
 			</a>
 		</div>
 	</div>
 	<div class="grid-x">
 		<div class="small-12 medium-11 cell">

 			@if(count($products))
 				<table class='hover unstriped' data-form="deleteForm">
 					<thead>
 						<tr>
 							<th>Image</th>
 						<th>Name</th>
 						<th>Price</th>
 						<th>Quantity</th>
 						<th>Category</th>
 						<th>Subcategory</th>
 						<th>Date Created</th>
 						<th width="70">Action</th>
 						</tr>
 						
 					</thead>
 					<tbody>
 						@foreach($products as $product)
 							<tr>
 								<td><img src="/02/public/{{$product['image_path']}}" alt="{{$product['name']}}" height="40" width="40"></td>
 								<td>{{$product['name']}}</td>
 								<td>{{$product['price']}}</td>
 								<td>{{$product['quantity']}}</td>
 								<td>{{$product['category_name']}}</td>
 								<td>{{$product['sub_category_name']}}</td>
 								<td>{{$product['added']}}</td>
 								<td width="70" class="text-right">
 									
 									<span class="has-tip top" aria-haspopup="true" data-disable-hover="false" data-tooltip tabindex="1" title="Edit Product">
 											<a href="/02/public/admin/product/{{$product['id']}}/edit">Edit<i class="fa fa-edit"></i></a>
 									</span>
 																					

 								</td>
 							</tr>
 						@endforeach
 					</tbody>
 				</table>
 				{!!$links!!}
 			@else
 				<h2>You have not created any category</h2>
 			@endif

 		</div>
 	</div>
 </div>



@endsection