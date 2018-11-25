@extends('layouts.app')
@section('title') {{$product->name}}@endsection
@section('data-page-id','product')

@section('content')
	<div class="product" id="product" v-cloak data-token="{{$token}}" data-id="{{$product->id}}">

		<div class="text-center">
			<i v-show="loading" class="fa fa-spinner">
				
			</i>
		</div>
		<section class="item-container">
			<div class="row column">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><a :href="'/02/public/product/category/'+category.slug">@{{category.name}}</a></li>
				    <li><a :href="'/02/public/product/subCategory/'+subCategory.slug">@{{subCategory.name}}</a></li>
				    <li>@{{product.name}}</li>
				    
				  </ul>
				</nav>
				
			</div>

			<div class="row collapse">
				<div class="small-12 medium-5 large-4 column">
					<div>
						<img :src="'/02/public/'+product.image_path" width="100%" height="200">
					</div>
				</div>
				<div class="small-12 medium-7 large-8 column">
					<div class="product-details">
						<h2>
							@{{product.name}}
							<p>@{{product.description}}</p>
							<h2>$@{{product.price}}</h2>
							<button class="button alert">Add to Cart</button>
						</h2>
						
					</div>
				</div>
			</div>
		</section>
	</div>

	
@stop