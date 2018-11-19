(function(){
	'use strict';

	HXXSTORE.admin.delete=function(){
		
        $('table[data-form="deleteForm"]').on('click', '.delete-item', function (e) {
            e.preventDefault();
            var form = $(this);

            $('#confirm').foundation('open').on('click', '#delete-btn', function () {
               form.submit();
            });
        });
	};
})();