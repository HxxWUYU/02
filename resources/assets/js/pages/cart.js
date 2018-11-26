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
				messgage:''
			},
			methods:{
				displayItems:function(){

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
								
							}
						});
					},1000);
				}
			},
			created:function(){
				this.displayItems();
			}
		});
	}
})();