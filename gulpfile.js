var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	var bootstrapPath	= 'node_modules/bootstrap-sass/assets',
		jqueryPath		= 'node_modules/jquery/dist',
		tinymcePath		= 'node_modules/tinymce',
		faPath			= 'node_modules/font-awesome';

    mix.less('style_admin.less')
    	.sass('bootstrap.scss')
    	.sass('font-awesome.scss')
    	//.version('/css/style_admin.css')
    	.scripts(['script_admin.js'], 'public/js/script_admin.js');
    	//.copy(bootstrapPath + '/fonts', 'public/fonts')
    	//.copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')
    	//.copy(jqueryPath + '/jquery.min.js', 'public/js')
    	//.copy(tinymcePath + '/tinymce.min.js', 'public/js/tinymce')
    	//.copy(tinymcePath + '/jquery.tinymce.min.js', 'public/js/tinymce')
    	//.copy(tinymcePath + '/plugins', 'public/js/tinymce/plugins')
    	//.copy(tinymcePath + '/skins', 'public/js/tinymce/skins')
    	//.copy(tinymcePath + '/themes', 'public/js/tinymce/themes')
    	//.copy(faPath + '/fonts', 'public/fonts');

    mix.less('style.less')
    	//.version('/css/style.css')
    	//.copy('node_modules/jquery.inputmask/dist/jquery.inputmask.bundle.js', 'public/js')
    	.scripts(['script.js'], 'public/js/script.min.js');
});
