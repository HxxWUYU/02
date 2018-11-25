(function(){
	'use strict';

	HXXSTORE.module={
		truncateString:function limit(string,value){
			if(string.length>value){
						return string.substring(0,value)+'...';
					}else{
					return string;
				}
		},
		addItemToCart:function(id,callback){

			var token = $(".display-products").data('token');
			if(!token||token==null){
				token = $('.product').data('token');
			}

			var postData=$.param({product_id:id,token:token});
			axios.post('/02/public/cart',postData).then(function(response){
				callback(response.data.success);
			})
		}
	}
})();