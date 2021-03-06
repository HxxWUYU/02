(function(){
	'use strict';
	
	$(document).foundation();
	
	$(document).ready(function(){
		//SWITCH PAGES
		switch($('body').data('page-id')){
			case 'auth':
				HXXSTORE.auth.validate();
				break;
			case 'cart':
				HXXSTORE.product.cart();
				break;
			case 'product':
				HXXSTORE.product.details();
				break;
			case 'home':
				HXXSTORE.homeslider.initCarousel();
				HXXSTORE.homeslider.homePageProducts();
				break;
			case 'adminProduct':
				HXXSTORE.admin.changeEvent();
				HXXSTORE.admin.delete();
				break;
			case 'adminCategories':
				HXXSTORE.admin.update();
				HXXSTORE.admin.delete();
				HXXSTORE.admin.create();
				break;
			case 'adminDashboard':
				HXXSTORE.admin.dashboard();
				break;
			default:
			//do nothing
		}

	
		
		// 	$('.feature-slider').slick({
  // slidesToShow: 3,
  // dots:true,
  // centerMode: true,
  // });
		

	});
})();