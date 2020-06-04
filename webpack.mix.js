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
 mix.autoload({
     quill: ['window.Quill']
 });

mix.js('resources/js/app.js', 'public/js/main.js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/argon-dashboard.scss', 'public/css/main-app.css');

mix.copyDirectory('node_modules/tinymce/plugins', 'public/js/plugins');
mix.copyDirectory('node_modules/tinymce/icons', 'public/js/icons');
mix.copyDirectory('node_modules/tinymce/skins', 'public/js/skins');
mix.copyDirectory('node_modules/tinymce/themes', 'public/js/themes');
mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/js/jquery.tinymce.js');
mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/js/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', 'public/js/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/js/tinymce.min.js');
