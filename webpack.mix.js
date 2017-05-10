const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/assets/spa/iepatch.js', 'public/spa/iepatch.js')
    .js('resources/assets/spa/main.js', 'public/spa/app.js')
    .extract(['axios', 'vue', 'vue-masked-input', 'vue-router', 'vue-youtube-embed'])
    .sass('resources/assets/spa/assets/scss/app.scss', 'public/spa')
    .sass('resources/assets/spa/assets/scss/vendor.scss', 'public/spa');
