const mix = require('laravel-mix');

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

mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2/css/select2.min.css',
    'resources/assets/admin/plugins/select2/css/select2-bootstrap4.min.css',
],'public/assets/admin/css/admin.css');

mix.copyDirectory(
    'resources/assets/admin/plugins/fontawesome-free/webfonts',
    'public/assets/admin/webfonts'
);
mix.copyDirectory(
    'resources/assets/admin/img',
    'public/assets/admin/img'
);

mix.copy(
    'resources/assets/admin/css/adminlte.min.css.map',
    'public/assets/admin/css/adminlte.min.css.map'
);
mix.copy(
    'resources/assets/admin/js/adminlte.min.js.map',
    'public/assets/admin/js/adminlte.min.js.map'
);

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.min.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
],'public/assets/admin/js/admin.js');




mix.styles([
  'resources/assets/front/css/vendor/bootstrap.min.css',
  'resources/assets/front/css/vendor/signericafat.css',
  'resources/assets/front/css/vendor/cerebrisans.css',
  'resources/assets/front/css/vendor/simple-line-icons.css',
  'resources/assets/front/css/vendor/elegant.css',
  'resources/assets/front/css/vendor/linear-icon.css',
  'resources/assets/front/css/plugins/nice-select.css',
  'resources/assets/front/css/plugins/easyzoom.css',
  'resources/assets/front/css/plugins/slick.css',
  'resources/assets/front/css/plugins/animate.css',
  'resources/assets/front/css/plugins/magnific-popup.css',
  'resources/assets/front/css/plugins/jquery-ui.css',
  'resources/assets/front/css/style.css',
],'public/assets/front/css/front.css');



mix.scripts([
    'resources/assets/front/js/vendor/modernizr-3.6.0.min.js',
    'resources/assets/front/js/vendor/jquery-3.5.1.min.js',
    'resources/assets/front/js/vendor/jquery-migrate-3.3.0.min.js',
    'resources/assets/front/js/vendor/bootstrap.bundle.min.js',
    'resources/assets/front/js/plugins/slick.js',
    'resources/assets/front/js/plugins/jquery.syotimer.min.js',
    'resources/assets/front/js/plugins/jquery.instagramfeed.min.js',
    'resources/assets/front/js/plugins/jquery.nice-select.min.js',
    'resources/assets/front/js/plugins/wow.js',
    'resources/assets/front/js/plugins/jquery-ui-touch-punch.js',
    'resources/assets/front/js/plugins/jquery-ui.js',
    'resources/assets/front/js/plugins/magnific-popup.js',
    'resources/assets/front/js/plugins/sticky-sidebar.js',
    'resources/assets/front/js/plugins/easyzoom.js',
    'resources/assets/front/js/plugins/scrollup.js',
    'resources/assets/front/js/plugins/ajax-mail.js',
    'resources/assets/front/js/main.js'
],'public/assets/front/js/front.js')

mix.copyDirectory('resources/assets/front/fonts','public/assets/front/fonts');





