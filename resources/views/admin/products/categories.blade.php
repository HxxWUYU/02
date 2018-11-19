@extends('admin.layout.base')
@section('title','Product Categories')
@section('data-page-id',"adminCategories")

@section('content')

 <div class="category">
 	<div class="row expanded">
 		<h2>Product Categories</h2>

 		
 	</div>
 	@include('includes.message')
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
 	<div class="row expanded">
 		<div class="small-12 medium-11 column">

 			@if(count($categories))
 				<table class='hover' data-form="deleteForm">
 					<tbody>
 						@foreach($categories as $category)
 							<tr>
 								<td>{{$category['name']}}</td>
 								<td>{{$category['slug']}}</td>
 								<td>{{$category['added']}}</td>
 								<td width="100" class="text-right">
 									<span class="has-tip top" data-tooltip tabindex="1" title="Add SubCategory" >
 											<a data-open="add-subcategory-{{$category['id']}}"><i class="fa fa-plus"></i></a>
 									</span>
 									<span class="has-tip top" data-tooltip tabindex="1" title="Edit Category">
 											<a data-open="item-{{$category['id']}}"><i class="fa fa-edit"></i></a>
 									</span>
	 									<!-- Delete Category-->
	 									<span class="has-tip top" data-tooltip tabindex="1" title="Delete Category" style="display:inline-block">
	 										<form method="POST" action="/02/public/admin/product/categories/{{$category['id']}}/delete"  class="delete-item">
	 											<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
	 											<button type="submit"><i class="fa fa-times delete"></i></button>
	 										</form>
	 										
	 									</span>
 									 <!--Edit Category Modal -->
 									<div class="reveal" id="item-{{$category['id']}}" data-reveal data-close-on-click="false" data-close-on-esc="false" data-animation-in="scale-in-up">
 										<div class="notification callout">
 											

 										</div>
									  <h2>Edit Category</h2>
									  <form>
						 				<div class='input-group'>
						 					<input type="text" id="item-name-{{$category['id']}}" value="{{$category['name']}}" name="name">
						 					<div>
						 						<input type="submit" class="button update-category" data-token="{{\App\Classes\CSRFToken::_token()}}" value="Update" id="{{$category['id']}}">
						 					</div>
						 				</div>
						 			  </form>
									  <a class="close-button" href="/02/public/admin/product/categories" aria-label="Close modal" type="button">
									    <span aria-hidden="true">&times;</span>
									  </a>
									</div>

									<!--End Edit Category Modal -->

									<!-- Edit SubCategory Modal-->
									<div class="reveal" id="add-subcategory-{{$category['id']}}" data-reveal data-close-on-click="false" data-close-on-esc="false" data-animation-in="scale-in-up">
 										<div class="notification callout">
 											

 										</div>
									  <h2>Add Subcategory</h2>
									  <form>
						 				<div class='input-group'>
						 					<input type="text" id="subcategory-name-{{$category['id']}}">
						 					<div>
						 						<input type="submit" class="button add-subcategory" data-token="{{\App\Classes\CSRFToken::_token()}}" value="Create" id="{{$category['id']}}">
						 					</div>
						 				</div>
						 			  </form>
									  <a class="close-button" href="/02/public/admin/product/categories" aria-label="Close modal" type="button">
									    <span aria-hidden="true">&times;</span>
									  </a>
									</div>
 								</td>
 							</tr>
 						@endforeach
 					</tbody>
 				</table>
 				{!!$links!!}
 			@else
 				<h3>You have not created any category</h3>
 			@endif

 		</div>
 	</div>
 </div>


 <div class="subcategory">
 	<div class="row expanded">
 		<h2>Sub Categories</h2>

 		
 	</div>
 	@include('includes.message')
 	
 	<div class="row expanded">
 		<div class="small-12 medium-11 column">

 			@if(count($subcategories))
 				<table class='hover' data-form="deleteForm">
 					<tbody>
 						@foreach($subcategories as $subcategory)
 							<tr>
 								<td>{{$subcategory['name']}}</td>
 								<td>{{$subcategory['slug']}}</td>
 								<td>{{$subcategory['added']}}</td>
 								<td width="100" class="text-right">
 									
 									<span class="has-tip top" data-tooltip tabindex="1" title="Edit Subategory">
 											<a data-open="item-subcategory-{{$subcategory['id']}}"><i class="fa fa-edit"></i></a>
 									</span>
	 									<!-- Delete Category-->
	 									<span class="has-tip top" data-tooltip tabindex="1" title="Delete Subcategory" style="display:inline-block">
	 										<form method="POST" action="/02/public/admin/product/categories/{{$subcategory['id']}}/delete"  class="delete-item">
	 											<input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
	 											<button type="submit"><i class="fa fa-times delete"></i></button>
	 										</form>
	 										
	 									</span>
 									 <!--Edit Subcategory Modal -->
 									<div class="reveal" id="item-subcategory-{{$subcategory['id']}}" data-reveal data-close-on-click="false" data-close-on-esc="false" data-animation-in="scale-in-up">
 										<div class="notification callout">
 											

 										</div>
									  <h2>Edit Subcategory</h2>
									  <form>
						 				<div class='input-group'>
						 					<input type="text" id="item-subcategory-name-{{$subcategory['id']}}" value="{{$subcategory['name']}}">

						 					<label>Change Category
						 						<select id="item-category-{{$subcategory['category_id']}}">
						 							@foreach(\App\Models\Category::all() as $category)
						 								@if($category->id==$subcategory['category_id'])
						 									<option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
						 								@else
						 								<option value="{{$category->id}}">{{$category->name}}</option>
						 								@endif
						 							@endforeach
						 						</select>

						 					</label>
						 					<div>
						 						<input type="submit" class="button update-subcategory" data-token="{{\App\Classes\CSRFToken::_token()}}" value="Update" id="{{$subcategory['id']}}">
						 					</div>
						 				</div>
						 			  </form>
									  <a class="close-button" href="/02/public/admin/product/categories" aria-label="Close modal" type="button">
									    <span aria-hidden="true">&times;</span>
									  </a>
									</div>

									<!--End Edit Category Modal -->

 								</td>
 							</tr>
 						@endforeach
 					</tbody>
 				</table>
 				{!!$subcategories_links!!}
 			@else
 				<h3>You have not created any subcategory</h3>
 			@endif

 		</div>
 	</div>
 </div>
@include('includes.delete-modal')
@endsection