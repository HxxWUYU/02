(function(){
	'use strict';
	
	$(document).foundation();
	
	$(document).ready(function(){
		//SWITCH PAGES
		switch($('body').data('page-id')){
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
			default:
			//do nothing
		}

	
		
			$('.feature-slider').slick({
			slidesToShow:4,
			autoplay:true,
			arrows:true,
			dots:true,
			fade:false,
			autoplayHoverPause:true,
			slideToScroll:1,
			cetnerMode:true

		});
		

	});
})();