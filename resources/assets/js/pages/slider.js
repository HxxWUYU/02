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

		$('.carousel').slick({
			slidesToShow: 3,
  dots:true,
  centerMode: true

		});
	}
})();