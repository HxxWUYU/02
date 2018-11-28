@extends('layouts.app')
@section('title') {{$product->name}}@endsection
@section('data-page-id','product')

@section('content')
	<div class="product" id="product" data-token="{{$token}}" data-id="{{$product->id}}">

		<div class="text-center">
			<img v-show="loading" src="/02/public/images/uploads/loading.gif">
		</div>
		<section class="item-container" v-cloak>
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
						
						<img :src="'/02/public/'+img" width="100%" height="200">
					</div>
				</div>
				<div class="small-12 medium-7 large-8 column">
					<div class="product-details">
						<h2>
							@{{product.name}}
							<p>@{{product.description}}</p>
							<h2>$@{{product.price}}</h2>
							

							 <button  v-if="product.quantity>0" @click.prevent="addToCart(product.id)" class="button cart ">
						    	Add to cart
						    </button>

						     <button v-else class="button cart" disabled style="color:grey;">
						    	Out of Stock
						    </button>
						</h2>
						
					</div>
				</div>
			</div>
		</section>

		<section class="home" v-cloak>
			<div class="display-products">
				<div class="row medium-up-2 large-up-4 feature-slider">
				<h2>Similar Products</h2>
				
				<div class="small-12 column" v-for="similar in similarProduct">
				<!-- <div class="column" v-for="feature in featured"> -->
					<a :href="'/02/public/product/'+similar.id">
						<div class="card" data-equalizer-watch>
						  <div class="card-section">
						    <img :src="'/02/public/'+similar.image_path" width="100%" height="200">
						  </div>
						  <div class="card-section">
						    <p>@{{stringLimit(similar.name,15)}}</p>
						    <a :href="'/02/public/product/'+similar.id" class="button more expanded">
						    	See More
						    </a>
						   

							 <button  v-if="similar.quantity>0" @click.prevent="addToCart(similar.id)" class="button cart expanded ">
						    	@{{similar.price}} - Add to cart
						    </button>

						     <button v-else class="button cart expanded" disabled style="color:grey;">
						    	Out of Stock
						    </button>
						  </div>
						</div>
					</a>
					

					
				</div>
			</div>
			</div>
		</section>
	</div>

	
@stop