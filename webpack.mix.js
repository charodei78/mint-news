const mix = require('laravel-mix');
require('laravel-mix-postcss-config');
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

mix.options({
  postCss: [
      require('tailwindcss'),
      require('postcss-cached'),
      require('postcss-import'),
      require('autoprefixer'),
    ]
})

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/ckeditor-init.js', 'public/js')
    .js('resources/js/ckeditor.js', 'public/js')
    .browserSync('localhost:8000')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/tailwind.css', 'public/css')
    .postCss('resources/css/utilities.css', 'public/css');

