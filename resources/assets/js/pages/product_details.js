(function(){
	'use strict';

	HXXSTORE.product.details=function(){
		var app = new Vue({
			el:'#product',
			data:{
				product:[],
				category:[],
				subCategory:[],
				productId:$('#product').data('id'),
				loading:false
			},

			methods:{
				getProductDetails:function(){
					this.loading=true;
					setTimeout(function(){
						axios.get('/02/public/product_details/'+app.productId)
						.then(function(response){
							app.product = response.data.product;
							app.category = response.data.category;
							app.subCategory = response.data.subCategory;
							app.loading=false;
						})	
					},4000);
				},
				stringLimit: function(string,value){
					if(string.length>value){
						return string.substring(0,value)+'...';
					}
					return string;
				}
			},
			created:function(){
				this.getProductDetails();
			}
		});
	}
})();
