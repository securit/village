const mix        = require('laravel-mix');
const cssImport  = require('postcss-import')
const cssNesting = require('postcss-nesting')
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
    .vue({runtimeOnly: true})
    .postCss('resources/css/app.css', 'public/css', [
        cssImport(),
        cssNesting(),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps()
}
