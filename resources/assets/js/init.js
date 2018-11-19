(function(){
	'use strict';
	
	$(document).foundation();
	
	$(document).ready(function(){
		//SWITCH PAGES
		switch($('body').data('page-id')){
			case 'home':
				break;
			case 'adminCategories':
				HXXSTORE.admin.update();
				HXXSTORE.admin.delete();
				HXXSTORE.admin.create();
				break;
			default:
			//do nothing
		}
	});
})();