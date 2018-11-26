import Slick from 'vue-slick';
(function(){
	'use strict';

	HXXSTORE.homeslider.initCarousel=function(){
		$('.hero-slider').slick({
			slidesToShow:1,
			autoplay:true,
			arrows:false,
			dots:false,
			fade:true,
			pauseOnHover:false,
			slideToScroll:1

		});

		
	}

	new Vue({
	    components: { Slick },
	    data() {
	            return {
	                    slickOptions: {
	                        //options can be used from the plugin documentation
	                        slidesToShow: 4,
	                        infinite: true,
	                        accessibility: true,
	                        adaptiveHeight: false,
	                        arrows: true,
	                        dots: true,
	                        draggable: true,
	                        edgeFriction: 0.30,
	                        swipe: true
	                    }
	            }
	    },
	    // All slick methods can be used too, example here
	    methods: {
	            next() {
	                    this.$refs.slick.next()
	            },
	            prev() {
	                    this.$refs.slick.prev()
	            },
	            reInit() {
	                    // Helpful if you have to deal with v-for to update dynamic lists
	                    this.$refs.slick.reSlick()
	            }
	    }
	});
})();