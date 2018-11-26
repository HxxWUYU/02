@extends('layouts.app')
@section('title',"Your shopping cart") 
@section('data-page-id','cart')

@section('content')
	<div class="shopping_cart" id="shopping_cart" style="padding:6rem;">

		<div class="text-center">
			<i v-show="loading" class="fa fa-spinner fa-spin">
				
			</i>
		</div>

		<section class="items" v-if="loading==false">
			<div class="row">
				<div class="small-12">
					<h2 v-if='fail' v-text="message"></h2>
					<div v-else>
						<h2>Your Cart</h2>
					</div>
				</div>
			</div>
		</section>
		
	</div>

	
@stop