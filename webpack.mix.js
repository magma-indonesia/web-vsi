const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").vue();
mix.less("resources/less/app.less", "public/css", {
    lessOptions: {
        math: "always",
        modifyVars: {
            "primary-color": "#042893",
            "link-color": "#042893",
        },
        javascriptEnabled: true,
    },
});
