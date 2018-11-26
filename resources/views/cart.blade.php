@extends('layouts.app')
@section('title',"Your shopping cart") 
@section('data-page-id','cart')

@section('content')
	<div class="shopping_cart" id="shopping_cart" style="padding:6rem;">

		<div class="text-center">
			<img src="/02/public/images/uploads/loading.gif">
		</div>

		<section class="items" v-if="loading==false">
			<div class="row">
				<div class="small-12">
					<h2 v-if='fail' v-text="message"></h2>
					<div v-else>
						<h2>Your Cart</h2>
						<table class="hover unstriped">
							<thead class="text-left">
								<tr>
									<th>#</th>
								<th>Product Name</th>
								<th>($)Price</th>
								<th>Qty</th>
								<th>Total</th>
								<th>Action</th>	
								</tr>
								<tbody>
									<tr v-for="item in items">
										<td class="medium-text-center">
											<a :href="'/02/public/product'+item.id">
												<img :src="'/02/public/'+item.image" height="60px" width="60px" alt="item.name">
											</a>
										</td>
										<td>
											
												<h5><a :href="'/02/public/product'+item.id">@{{item.name}}</a></h5>
												Status:
												<span v-if="item.stock>1" style="color:#00AA00;">
													In Stock
												</span>
												<span v-else style="color:#ff0000;">
													Out of Stock
												</span>
											
										</td>
										<td>
											@{{item.price}}
										</td>
										<td>
											@{{item.quantity}}
										</td>
										<td>
											@{{item.totalPrice}}
										</td>
										<td class="text-center">
											<button>
												<i class="fa fa-times" aria-hidden="true"></i>
											</button>
										</td>
									</tr>
								</tbody>
								
							</thead>
						</table>
					</div>
				</div>
			</div>
		</section>
		
	</div>

	
@stop