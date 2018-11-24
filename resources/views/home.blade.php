@extends('layouts.app')
@section('title','Homepage')
@section('data-page-id','home')

@section('content')
	<div class="home">
		<section class="hero">
			<div class="hero-slider">
				<div >
					<img src="/02/public/images/sliders/slide_1.jpg" alt='Hxx Store' >
				</div>
				<div >
					<img src="/02/public/images/sliders/slide_2.jpg" alt='Hxx Store' >
				</div>
				<div >
					<img src="/02/public/images/sliders/slide_3.jpg" alt='Hxx Store' >
				</div>
			</div>
		</section>
		<section class="display-products" id="root">
			<div class="row medium-up-4 feature-slider">
				<h2>Featured Products</h2>
				<div class="small-12 column " v-for="feature in featured">
					<!-- <a :href="'/product/'+feature.id">
						<div class="card" data-equalizer-watch>
						  <div class="card-section">
						    <img :src="'/02/public/'+feature.image_path" width="100%" height="200">
						  </div>
						  <div class="card-section">
						    <p>@{{stringLimit(feature.name,18)}}</p>
						    <a :href="'/product/'+feature.id" class="button more expanded">
						    	See More
						    </a>
						    <a :href="'/product/'+feature.id" class="button cart expanded">
						    	@{{feature.price}} - Add to cart
						    </a>
						  </div>
						</div>
					</a> -->
					<div>
					<a :href="'/product/'+feature.id">
						<div class="card" data-equalizer-watch>
						  <div class="card-section">
						    <img :src="'/02/public/'+feature.image_path" width="100%" height="200">
						  </div>
						  <div class="card-section">
						    <p>@{{stringLimit(feature.name,18)}}</p>
						    <a :href="'/product/'+feature.id" class="button more expanded">
						    	See More
						    </a>
						    <a :href="'/product/'+feature.id" class="button cart expanded">
						    	@{{feature.price}} - Add to cart
						    </a>
						  </div>
						</div>
					</a>
					</div>
				</div>
				
			</div>

			<div class="row medium-up-4">
				<h2>Products</h2>
				<div class="small-12 column" v-for="product in products">
					<a :href="'/product/'+product.id">
						<div class="card" data-equalizer-watch>
						  <div class="card-section">
						    <img :src="'/02/public/'+product.image_path" width="100%" height="200">
						  </div>
						  <div class="card-section">
						    <p>@{{stringLimit(product.name,18)}}</p>
						    <a :href="'/product/'+product.id" class="button more expanded">
						    	See More
						    </a>
						    <a :href="'/product/'+product.id" class="button cart expanded">
						    	@{{product.price}} - Add to cart
						    </a>
						  </div>
						</div>
					</a>
				</div>
				
			</div>

		</section>
	</div>
	
@stop