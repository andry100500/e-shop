<?php

use Illuminate\Support\Facades\Route;
use App\Http\Services\ControllerManager;

// Сайтмап для робота, общий
Route::get('/sitemap.xml', [\App\Http\Controllers\Front\SitemapXMLController::class, 'index']);

// Сохрание отзыва о товаре
Route::post('/store-review/{product_id}', [\App\Http\Controllers\Front\ProductController::class, 'storeReview'])->name('store-review');

// Подписка
Route::post('subscribe', [\App\Http\Controllers\Front\SubscribeController::class, 'subscribe'])->name('subscribe');

Route::group(
    [
        'middleware' => 'setLocale',
        'prefix' => \App\Http\Services\RoutePrefixManager::getPrifix(),
    ],

    function () {
        Route::get('/', [\App\Http\Controllers\Front\MainPageController::class, 'index']);

        Route::get('/blog/', [\App\Http\Controllers\Front\PostController::class, 'index']);
        Route::get('/blog/{slug}', [\App\Http\Controllers\Front\PostController::class, 'show']);

//        Route::get('/brands/', [\App\Http\Controllers\Front\BrandController::class, 'index']);
//        Route::get('/brands/{slug}', [\App\Http\Controllers\Front\BrandController::class, 'show']);

        Route::get('/info/{slug}', [\App\Http\Controllers\Front\PageController::class, 'show']);

        Route::get('/sitemap/', [\App\Http\Controllers\Front\SitemapUserController::class, 'show']);

        Route::get('/contact-us/', [\App\Http\Controllers\Front\ContactController::class, 'index']);

        // Корзина
        Route::get('/basket/', [\App\Http\Controllers\Front\BasketController::class, 'show']);
        Route::post('/basket/make-order', [\App\Http\Controllers\Front\BasketController::class, 'makeOrder']);
        Route::get('/order-done/', [\App\Http\Controllers\Front\OrderController::class, 'orderDone'])->name('order-done');

        // Закладки
        // TODO -  удалить, если не понадобится (маршрут, контроллер и шаблоны)
        // Route::get('/wishlist/', [\App\Http\Controllers\Front\WishListController::class, 'index']);

        // Кабинет
        Route::get('/login/', [\App\Http\Controllers\Front\LoginController::class, 'index']);
        Route::get('/my-account/', [\App\Http\Controllers\Front\CabinetController::class, 'index']);

        // Сайтмапы сущностей
        Route::get('/categories.xml', [\App\Http\Controllers\Front\SitemapXMLController::class, 'categories']);
        Route::get('/products.xml', [\App\Http\Controllers\Front\SitemapXMLController::class, 'products']);
        Route::get('/blog.xml', [\App\Http\Controllers\Front\SitemapXMLController::class, 'blog']);
        Route::get('/pages.xml', [\App\Http\Controllers\Front\SitemapXMLController::class, 'pages']);

        // Страницы категоррий и товаров
        Route::get('{any}', [ControllerManager::class, 'run'])->where('any', '.*')->name('catalog');

    });
