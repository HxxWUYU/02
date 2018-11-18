(function(){
	'use strict';

	HXXSTORE.admin.update = function(){
		//update product category
		$(".update-category").on('click',function(e){

			
			var token = $(this).data("token");
			var id = $(this).attr('id');
			var name = $("#item-name"+id).val();

			alert(token+ ' and id= '+id+" name= "+name);
			e.preventDefault();

		});
	};
})();