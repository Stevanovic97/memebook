let mix = require('laravel-mix');

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

// mix.js('public/js/app.js', 'dist/').css('public/jss/app.css', 'dist/');

mix.js('resources/assets/js/app.js', 'public/js')
    .css('public/jss/app.css', 'dist/');
   