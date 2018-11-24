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
						app.featured = response.data.featured;
						app.loading=false;

					});
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

