let mix  = require('laravel-mix');
mix.js('resources/js/landings.js', 'public/js')
    .autoload({ jquery: ['$', 'window.jQuery', 'jQuery'] })
    .copyDirectory('resources/assets', 'public/assets')
    .sass('resources/sass/landings.scss', 'public/css');
