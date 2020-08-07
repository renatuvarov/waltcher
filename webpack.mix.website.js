let mix  = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js')
    .autoload({ jquery: ['$', 'window.jQuery', 'jQuery'] })
    .copyDirectory('resources/assets', 'public/assets')
    .sass('resources/sass/app.scss', 'public/css');
