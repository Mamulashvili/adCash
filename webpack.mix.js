const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .alias({
        '@components': path.resolve(__dirname, 'resources/js/components'),
        '@pages': path.resolve(__dirname, 'resources/js/pages'),
        '@layouts': path.resolve(__dirname, 'resources/js/layouts'),
        '@assets': path.resolve(__dirname, 'resources/assets'),
        '@icons': path.resolve(__dirname, 'resources/assets/icons'),
        '@publicDir': path.resolve(__dirname, 'public'),
        '@utils': path.resolve(__dirname, 'resources/js/utils'),
    })
    .sass('resources/assets/sass/main.scss', 'public/css');


