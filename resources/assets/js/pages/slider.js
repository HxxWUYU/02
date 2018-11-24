(function(){
	'use strict';

	HXXSTORE.homeslider.initCarousel=function(){
		$('.hero-slider').slick({
			slidesToShow:1,
			autoplay:true,
			arrows:false,
			dots:false,
			fade:true,
			autoplayHoverPause:true,
			slideToScroll:1

		});

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
	}
})();