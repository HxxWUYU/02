(function(){
	'use strict';

	HXXSTORE.admin.changeEvnet = function(){
		$("#product-category").on('change',function(){
			var category_id = $('#product-category'+" option:selected").val();
			$.ajax({
				type:"post",
				url:'/02/public/admin/category/'+category_id+'/selected',
				data:{category_id:category_id},
				success:function(response){
					var subcategories = $.parseJSON(response);
					if(subcategories.length>0){
						$.each(subcategories,function(key,value){
							$('#product-subcategory').append('<option value="'
								+value.id+'">'+value.name+'</option>');
						});
					}else{
						$('#product-subcategory').append('<option value="">No record found</option>');

					}
				}
			});
		});
	}
})();