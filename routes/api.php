<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Корзина
Route::post('/basket/add', [\App\Http\Controllers\Api\BasketController::class, 'addToBasket']);
Route::post('/basket/subtract', [\App\Http\Controllers\Api\BasketController::class, 'subtractFromBasket']);
Route::post('/basket/remove', [\App\Http\Controllers\Api\BasketController::class, 'removeFromBasket']);
Route::post('/basket/set-product-count', [\App\Http\Controllers\Api\BasketController::class, 'setProductCount']);
Route::get('/basket/get-produts-count', [\App\Http\Controllers\Api\BasketController::class, 'getProductscount']);

Route::get('/basket/get-modal', [\App\Http\Controllers\Api\BasketController::class, 'getModal']);





// Закладки
//Добавить в закладки
Route::post('/wishlist/add', [\App\Http\Controllers\Api\WishlistController::class, 'addToWishlist']);
// Удалить из закладок
Route::post('/wishlist/remove', [\App\Http\Controllers\Api\WishlistController::class, 'removeFromWishlist']);
// Модальное окно
Route::get('/wishlist/get-modal', [\App\Http\Controllers\Api\WishlistController::class, 'getModal']);
// Кодличество товаров в закладках
Route::get('/wishlist/get-produts-count', [\App\Http\Controllers\Api\WishlistController::class, 'wishlistProductCount']);
