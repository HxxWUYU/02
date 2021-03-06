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
				similarProduct:[],
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
						app.similarProduct = response.data.similarProduct;
						app.loading=false;
					})
				},
				stringLimit: function(string,value){
					return HXXSTORE.module.truncateString(string,value);
				},
				addToCart:function(id){
					HXXSTORE.module.addItemToCart(id,function(message){			
											 $('.notify').css('display','block').delay(4000).slideUp(300).html(message);
					});
				}
			},
			created:function(){
				this.getProductDetails();
			}
		});
	}
})();
