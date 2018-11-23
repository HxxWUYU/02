(function(){
	'use strict';

	HXXSTORE.homeslider.homePageProducts = function(){
		var app= new Vue({
			el:'#root',
			data:{
				featured:[],
				loading:false
			},
			
			methods:{
				getFeaturedProducts:function(){
					this.loading = true;
					axios.get('/02/public/featured').then(function(response){
						console.log(response.data);

					});
				}
			},

			created:function(){
				this.getFeaturedProducts();
			}
		});
	}
})();