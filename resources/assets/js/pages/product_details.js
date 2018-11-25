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
				img:[],
				loading:false
			},

			methods:{
				getProductDetails:function(){
					this.loading=true;
					axios.get('/02/public/product_details/'+this.productId)
					.then(function(response){
						app.product = response.data.product;
						app.category = response.data.category;
						app.subCategory = response.data.subCategory;
						app.img = response.data.product.image_path;
						app.loading=false;
					})
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
