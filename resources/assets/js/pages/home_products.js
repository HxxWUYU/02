(function(){
	'use strict';

	HXXSTORE.homeslider.homePageProducts = function(){
		var app= new Vue({
			el:'#root',
			data:{
				featured:[],
				products:[],
				loading:false
			},

			methods:{
				getFeaturedProducts:function(){
					this.loading = true;
					axios.all(
						[
							axios.get('/02/public/featured'),
							axios.get('/02/public/get_products')
						]
					).then(axios.spread(function(featuredResponse,productsResponse){
						app.featured = featuredResponse.data.featured;
						app.products = productsResponse.data.products;
						app.loading = true;
					}))
					
				},

				stringLimit: function(string,value){
					if(string.length>value){
						return string.substring(0,value)+'...';
					}
					return string;
				}


			},

			created:function(){
				this.getFeaturedProducts();

			}
		});

		
	}
})();

