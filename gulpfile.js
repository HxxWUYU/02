var elixir = require("laravel-elixir");

elixir.config.sourcemaps = false;

var gulp = require('gulp');

elixir(function (mix){
	//compile sass to css
	mix.sass('resources/assets/sass/app.scss','resources/assets/css');

	//combine css file
	mix.styles(
		[
			'css/app.css',
			'bower/vendor/slick-carousel/slick/slick.css',
			'bower/vendor/slick-carousel/slick/slick-theme.css'

		],
		'public/css/all.css',//Output file
		'resources/assets'//source
	);

	var bowerPath = 'bower/vendor';

	mix.scripts(
		[
		//Jquery
		bowerPath + '/jquery/dist/jquery.min.js',

		//foundation js
		bowerPath + '/foundation-sites/dist/js/foundation.min.js',

		//carousel slick
		bowerPath + '/slick-carousel/slick/slick.min.js',

		//Axios js
		bowerPath + '/axios/dist/axios.min.js',

		'js/hxx.js',
		'js/admin/*.js',
		'js/pages/*.js',
		'js/init.js',

		], 'public/js/all.js','resources/assets'
	);
});