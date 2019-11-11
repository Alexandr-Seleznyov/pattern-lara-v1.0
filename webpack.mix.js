const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/js/frontend/app.js', 'public/js/frontend')
   .js('resources/js/backend/app.js', 'public/js/backend')
   // .js('resources/js/coreui/main.js', 'public/js/coreui')

   .sass('resources/sass/frontend/app.scss', 'public/css/frontend')
   .sass('resources/sass/backend/app.scss', 'public/css/backend')
   // .sass('resources/js/coreui/assets/scss/style.scss', 'public/css/coreui')

   .browserSync({
       proxy: 'http://pl1.loc:80'
   });


// mix.webpackConfig({
//     resolve  : {
//         alias: {
//             '@' : path.resolve(__dirname, 'resources/js/coreui/'),
//         },
//     },
// })
