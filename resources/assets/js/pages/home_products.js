(function(){
	'use strict';

	HXXSTORE.homeslider.homePageProducts = function(){
		var app= new Vue({
			el:'#root',
			data:{
				featured:[],
				products:[],
				loading:false,
				count:0
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
						app.count = productsResponse.data.count;
						app.loading = false;
					}))
					
				},

				stringLimit: function(string,value){
					if(string.length>value){
						return string.substring(0,value)+'...';
					}
					return string;
				},

				loadMoreProducts:function(){
					var token = $('.display-products').data('token');
					this.loading = true;
					var data = $.param({next:2,token:token,count:app.count});
					axios.post('/02/public/load_more',data).then(function(response){
						app.products = response.data.products；
						app.count = response.data.count;
						app.loading = false;
					});
				}


			},

			created:function(){
				this.getFeaturedProducts();

			},
			mounted:function(){
				$(windows).scroll(function(){
					if(($(window).scrollTop()+$(window).height())==$(document).height()){
						app.loadMoreProducts();
					}
				});
			}
		});


	}
})();

