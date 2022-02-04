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

mix.css('resources/css/front/common.css', 'public/css/common.css');
mix.css('resources/css/front/header.css', 'public/css/common.css');
mix.css('resources/css/front/footer.css', 'public/css/common.css');
mix.css('resources/css/front/bread-crumbs.css', 'public/css/common.css');
mix.css('resources/css/front/category-page.css', 'public/css/common.css');
mix.css('resources/css/front/product-page.css', 'public/css/common.css');
mix.css('resources/css/front/main-page.css', 'public/css/common.css');
mix.css('resources/css/front/info-page.css', 'public/css/common.css');
mix.css('resources/css/front/user-sitemap.css', 'public/css/common.css');
mix.css('resources/css/front/brands.css', 'public/css/common.css');
mix.css('resources/css/front/blog.css', 'public/css/common.css');
mix.css('resources/css/front/article.css', 'public/css/common.css');
mix.css('resources/css/front/basket.css', 'public/css/common.css');
mix.css('resources/css/front/contacts-page.css', 'public/css/common.css');
mix.css('resources/css/front/thank-you-page.css', 'public/css/common.css');
mix.css('resources/css/front/login.css', 'public/css/common.css');




mix.js('resources/js/common.js', 'public/js');
mix.js('resources/js/category.js', 'public/js');
mix.js('resources/js/product.js', 'public/js');
mix.js('resources/js/basket-page.js', 'public/js');
mix.js('resources/js/basket-modal.js', 'public/js');
mix.js('resources/js/wishlist-page.js', 'public/js');
mix.js('resources/js/wishlist-modal.js', 'public/js');

