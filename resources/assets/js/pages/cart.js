(function(){
	'use strict';

	HXXSTORE.product.cart=function(){

		var stripe = StripeCheckout.configure({
			key:$('#properties').data('stripe-key'),
			locale:'auto',
			token:function(token){
				var data = $.param({stripeToken:token.id,stripeEmail:token,email});
				axios.post('/02/public/cart/payment',data).then(function(response){
					 	$('.notify').css('display','none').stop(true,true).clearQueue().slideDown(400).delay(4000).slideUp(300).html(response.data.success);
					 	app.displayItems(100);
				}).catch(function(error){
					console.log(error);
				});
			}
		});
		
		var app = new Vue({
			el:'#shopping_cart',
			data:{
				items:[],
				cartTotal:0,
				loading:false,
				fail:false,
				messgage:'',
				authenticated:false,
				amount:0
			},
			methods:{
				displayItems:function(time){

					this.loading=true;
					setTimeout(function(){
						axios.get('/02/public/cart/items').then(function(response){
							if(response.data.fail){
								app.fail=true;
								app.message=response.data.fail;
								app.loading=false;
							}else{
								app.items = response.data.items;
								app.cartTotal = response.data.cartTotal;
								app.loading=false;
								app.authenticated = response.data.authenticated;
								app.amount = response.data.amount;

							}
						});
					},time);
				},
				updateQty:function(id,operator){

					var postData = $.param({product_id:id,operator:operator});
					axios.post('/02/public/cart/update_qty',postData).then(function(response){
						app.displayItems(100);
					});
				},
				removeItem:function(index){
					var postData = $.param({item_index:index});
					axios.post('/02/public/cart/remove',postData).then(function(response){
					$('.notify').css('display','none').stop(true,true).clearQueue().slideDown(400).delay(4000).slideUp(300).html(response.data.success);

						app.displayItems(100);
					});
					// var postData = $.param({item_index:index});
					// axios.post('/02/public/cart/remove').then(function(response){

					
					// });
				},
				clearChart:function(){
					axios.get('/02/public/cart/clear').then(function(response){
					$('.notify').css('display','none').stop(true,true).clearQueue().slideDown(400).delay(4000).slideUp(300).html(response.data.success);

						app.displayItems(100);
					});
				},
				checkout:function(){
					Stripe.open({
						name:"Hxx Store",
						description:"Shopping Cart Items",
						email:$("#properties").data("customer-email"),
						price:app.amount,
						zipCode:true
					})
				}

			},
			created:function(){
				this.displayItems(2000);
			}
		});
	}
})();