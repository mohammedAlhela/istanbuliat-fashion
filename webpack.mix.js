const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    ;
// mix.sass('resources/sass/customers/customers.scss', 'public/css')
mix.sass('resources/sass/admins/admins.scss', 'public/css')


mix.copyDirectory("node_modules/lightgallery/fonts", "public/fonts");
