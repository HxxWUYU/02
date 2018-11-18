(function(){
	'use strict';

	HXXSTORE.admin.update = function(){
		//update product category
		$(".update-category").on('click',function(e){

			
			var token = $(this).data("token");
			var id = $(this).attr('id');
			var name = $("#item-name-"+id).val();

			$.ajax({
				type:'post',
				url:'/02/public/admin/product/categories/'+id+'/edit',
				data:{token:token,name:name},
				success:function(data){
					var response = JQuery.parseJSON(data); //Convert json object to js object
					$(".notification").css("display","block").delay(4000).slideUp(300)
					.html(response.success);
				},
				error:function(request,error){
					var errors = JQuery.parseJson(request.responseText);
					var ul = document.createElement('ul');
					$.each(errors,function(key,value){
						var li = document.createElement('li');
						li.appendChild(document.createTextNode(value));
						ul.appendChild(li);
					});
			$(".notification").css("display","block").removeClass('primary')
			.addClass('alert').delay(6000).slideUp(300)
					.html(ul);

				}

			});
			e.preventDefault();

		});
	};
})();