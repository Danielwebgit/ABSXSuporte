const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/views/site/css/style.css'
],'public/site/css/style.css')

.scripts([
    'resources/views/site/js/script.js',
    'resources/views/site/js/jquery.js',

],'public/site/js/script.js');