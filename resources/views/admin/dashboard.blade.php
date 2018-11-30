@extends('admin.layout.base')
@section('title','Dashboard')
@section('data-page-id','adminDashboard')

@section('content')

 <div class="dashboard admin_shared">
 	<div class="grid-x" data-equalizer data-equalizer-on="medium">
 		<!-- Order Summary -->
 		<div class="small-12 medium-3 cell summary" data-equalizer-watch>
 			<div class="card">
 				<div class="card-section">
 					<div class="grid-x">

 						<div class="small-3 cell">
 							<i class="fa fa-shopping-cart" aria-hidden="true"> </i>
 						</div>
 						<div class="small-9 cell text-left">
 							<p>Total Orders</p>
 							<h4>{{$orders}}</h4>
 						</div>
 					</div>
 				</div>

 				<div class="card-divider">
 					<div class="grid-x cell">
 						<a href="#">Order Details</a>
 					</div>
 				</div>
 			</div>
 		</div>

 		<!-- Stock Summary -->
 		<div class="small-12 medium-3 cell summary" data-equalizer-watch>
 			<div class="card">
 				<div class="card-section">
 					<div class="grid-x">

 						<div class="small-3 cell">
 							<i class="fa fa-thermometer-empty" aria-hidden="true"> </i>
 						</div>
 						<div class="small-9 cell text-left">
 							<p>Stock</p>
 							<h4>{{$products}}</h4>
 						</div>
 					</div>
 				</div>

 				<div class="card-divider">
 					<div class="grid-x cell">
 						<a href="/02/public/admin/product/inventory">View Products</a>
 					</div>
 				</div>
 			</div>
 		</div>

 		<!-- Revenue Summary -->
 		<div class="small-12 medium-3 cell summary" data-equalizer-watch>
 			<div class="card">
 				<div class="card-section">
 					<div class="grid-x">

 						<div class="small-3 cell">
 							<i class="fa fa-money" aria-hidden="true"> </i>
 						</div>
 						<div class="small-9 cell text-left">
 							<p>Revenue</p>
 							<h4>${{number_format($payments,2)}}</h4>
 						</div>
 					</div>
 				</div>

 				<div class="card-divider">
 					<div class="grid-x cell">
 						<a href="#">Payment details</a>
 					</div>
 				</div>
 			</div>
 		</div>

 		<!-- Signup Summary -->
 		<div class="small-12 medium-3 cell summary" data-equalizer-watch>
 			<div class="card">
 				<div class="card-section">
 					<div class="grid-x">

 						<div class="small-3 cell">
 							<i class="fa fa-user" aria-hidden="true"> </i>
 						</div>
 						<div class="small-9 cell text-left">
 							<p>Signup</p>
 							<h4>{{$users}}</h4>
 						</div>
 					</div>
 				</div>

 				<div class="card-divider">
 					<div class="grid-x cell">
 						<a href="#">Registered Users</a>
 					</div>
 				</div>
 			</div>
 		</div>

 		
 	</div>

 	<div class="grid-x collapse expanded graph">
 		<div class="small-12 medium-6 cell monthly-sales">
 			<div class="card">
 				<div class="card-section">
 					<h4>
 						Monthly Orders
 					</h4>
 					<canvas id="order">
 						
 					</canvas>
 				</div>
 			</div>
 		</div>

 		<div class="small-12 medium-6 cell monthly-revenue">
 			<div class="card">
 				<div class="card-section">
 					<h4>
 						Monthly Revenue
 					</h4>
 					<canvas id="revenue">
 						
 					</canvas>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>

@endsection