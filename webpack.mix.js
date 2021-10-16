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

mix.setPublicPath('public')
    .sass('resources/sass/app.scss', 'assets/css')
    .js('resources/js/apps.js', 'assets/js')
    .js('resources/js/app.js', 'assets/js')
    .babel([
        'node_modules/jquery/dist/jquery.min.js',
        'resources/js/app.js',
        'node_modules/owl.carousel/dist/owl.carousel.min.js',
        'node_modules/bulma-accordion/dist/js/bulma-accordion.min.js',
        'node_modules/typed.js/lib/typed.min.js',
    ], 'public/assets/js/app.js')
    .copy('public/assets/css/app.css', 'admin/project/public/landings/css/landing-app.css')
    .copy('public/assets/js/app.js', 'admin/project/public/landings/js/landing-app.js')
    .copy('public/assets/js/apps.js', 'admin/project/public/landings/js/landing-apps.js')
    .copy('node_modules/aos/dist/aos.js', 'admin/project/public/landings/js/animate.js')
    .copy('node_modules/animate.css/animate.min.css', 'admin/project/public/landings/css/animate.css')
    .options({
        processCssUrls: false
    });
