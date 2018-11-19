(function(){
	'use strict';

	HXXSTORE.admin.create = function(){
		//create sub category
		$(".add-subcategory").on('click',function(e){

			
			var token = $(this).data("token");
			var category_id = $(this).attr('id');
			var name = $("#subcategory-name-"+category_id).val();

			$.ajax({
				type:'post',
				url:'/02/public/admin/product/subcategory/create',
				data:{token:token,name:name,category_id:category_id},
				success:function(data){
					var response = $.parseJSON(data); //Convert json object to js object
					$(".notification").addClass('primary').removeClass('alert').css("display","block").delay(4000).slideUp(300)
					.html(response.success);
				},
				error:function(request,error){
					var errors = $.parseJSON(request.responseText);
					var ul = document.createElement('ul');
					$.each(errors,function(key,value){
						if(value.length>1){
							$.each(value,function(k,v){
								var li = document.createElement('li');
								li.appendChild(document.createTextNode(v));
								ul.appendChild(li);
							});
						}else{
							var li = document.createElement('li');
							li.appendChild(document.createTextNode(value));
							ul.appendChild(li);	
						}
								
					});
				$(".notification").css("display","block").removeClass('primary')
			.addClass('alert').delay(4000).slideUp(300)
					.html(ul);

				}

			});
			e.preventDefault();

		});
	};
})();