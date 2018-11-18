(function(){
	'use strict';

	HXXSTORE.admin.update = function(){
		//update product category
		$(".update-category").on('click',function(e){

			
			var token = $(this).data("token");
			var id = $(this).attr('id');
			alert(token + ' '+id);
			e.preventDefault();

		});
	};
})();