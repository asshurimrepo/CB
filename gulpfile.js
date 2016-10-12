var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
       .sass('auth.scss')
       .sass('project-player.scss')
       .sass('premade-player.scss');

    mix.browserify('main.js').version('js/main.js');

    mix.browserify('upload.js').
    	browserify('premade.js').
    	browserify('caster.js').
    	browserify('admin-premade.js');
});
