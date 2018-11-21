(function(){
	'use strict';

	HXXSTORE.admin.changeEvent = function(){

		$("#product-category").on('change',function(){
			alert(1);
			var category_id = $('#product-category'+" option:selected").val();

			$('#product-subcategory').html('Select Subcategory');
			if(category_id.length>0){
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
			}
		
		});

		$("#product-subcategory").on('change',function(){
			var subcategoryname = document.querySelector("input[name='subcategoryname']");
			var subcategory_name = $('#product-subcategory'+" option:selected").text();
			subcategoryname.setAttribute('value',subcategory_name);
		});
	};
})();