(function(){
	'use strict';

	HXXSTORE.product.cart=function(){
		// alert(1);
		var app = new Vue({
			el:'#shopping_cart',
			data:{
				items:[],
				cartTotal:[],
				loading:false,
				fail:false,
				messgage:'',
				authenticated:false
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
							$('.notify').slideDown(400).delay(3000).slideUp(300).
						html(response.data.success);
						app.displayItems(100);
					});
					// var postData = $.param({item_index:index});
					// axios.post('/02/public/cart/remove').then(function(response){

					
					// });
				},
				clearChart:function(){
					axios.get('/02/public/cart/clear').then(function(response){
						$('.notify').slideDown(400).delay(3000).slideUp(300).
						html(response.data.success);
						app.displayItems(100);
					});
				}

			},
			created:function(){
				this.displayItems(2000);
			}
		});
	}
})();