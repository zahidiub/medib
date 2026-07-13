const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue() // Ensure Vue is being handled here
    .sass('resources/sass/app.scss', 'public/css');
