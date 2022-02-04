<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\BasketResource;
use App\Http\Services\Images\ImageLinkManager;
use App\Models\Basket;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;

class BasketController extends Controller
{


    /**
     * Добавляет товар в корзину или увеличивает количество
     */
    public function addToBasket()
    {
        if (request()->product_id) {
            $basketRow = Basket::where('product_id', request()->product_id)
                ->where('app_user_id', $_COOKIE['app_user_id'])
                ->first();

            if ($basketRow === null) {
                $basketRow = new Basket();
                $basketRow->app_user_id = $_COOKIE['app_user_id'];
                $basketRow->product_id = request()->product_id;
            }

            $basketRow->count += 1;
            $basketRow->save();
        }

    }

    /**
     * Удаляет товар из корзины
     */
    public function removeFromBasket()
    {
        if (request()->product_id) {
            $basketRow = Basket::where('product_id', request()->product_id)
                ->where('app_user_id', $_COOKIE['app_user_id'])
                ->first();
            $basketRow->delete();
        }

    }


    /**
     * Уменьшает количество товара в корзине
     */
    public function subtractFromBasket()
    {
        if (request()->product_id) {
            $basketRow = Basket::where('product_id', request()->product_id)
                ->where('app_user_id', $_COOKIE['app_user_id'])
                ->first();

            if ($basketRow->count > 1) {
                $basketRow->count -= 1;
                $basketRow->save();
            }
        }
    }

    /**
     * Изменяет количество товара в корзине, если пользователь вручную вводит его количество в поле count в корзине
     */
    public function setProductCount()
    {
        if (request()->product_id && request()->count) {
            $basketRow = Basket::where('product_id', request()->product_id)
                ->where('app_user_id', $_COOKIE['app_user_id'])
                ->first();
            $basketRow->count = request()->count;
            $basketRow->save();
        }
    }

    public function getProductscount()
    {
        $basketRows = Basket::where('app_user_id', $_COOKIE['app_user_id'])->get();
        $count = 0;
        if (count($basketRows) >= 0) {
            foreach ($basketRows as $basketRow) {
                $count += $basketRow->count;
            }
        }
        return $count;

        $count = Basket::where('app_user_id', $_COOKIE['app_user_id'])->count();
        return $count;
    }




    /**
     * Возвращает модальное окно корзины
     * @return void
     */
    public function getModal()
    {
        $basketRows = Basket::where('app_user_id', $_COOKIE['app_user_id'])->get();

        if ($basketRows) {
            $productIds = [];
            $productCounts = [];
            $total = 0;
            foreach ($basketRows as $basketRow) {
                $productIds[] = $basketRow->product_id;
                $productCounts[$basketRow->product_id] = $basketRow->count;

            }

            $products = Product::with(['productDescription'])->whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $total += $product->price * $productCounts[$product->id];
                $product->image = ImageLinkManager::getImageUrl($product->image, 'small');
            }
        }

        return view('front.basket.basket-modal-layout', compact('products',
            'productCounts', 'total'));
    }






}
