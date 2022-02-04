<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Images\ImageLinkManager;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class WishlistController extends Controller
{
    public function addToWishlist()
    {


        if (request()->product_id &&
            Wishlist::where('app_user_id', $_COOKIE['app_user_id'])
                ->where('product_id', request()->product_id)
                ->count() === 0
        ) {
            $wishlistRow = new Wishlist();
            $wishlistRow->app_user_id = $_COOKIE['app_user_id'];
            $wishlistRow->product_id = request()->product_id;

            $wishlistRow->save();

        }

    }

    public function removeFromWishlist()
    {
        if (request()->product_id) {
            $wishlistRow = Wishlist::where('app_user_id', $_COOKIE['app_user_id'])
                ->where('product_id', request()->product_id)->first();
            $wishlistRow->delete();
        }
    }

    public function wishlistProductCount()
    {
        $count = Wishlist::where('app_user_id', $_COOKIE['app_user_id'])->count();

        return $count;

    }

    public function getModal()
    {
        $products = [];

        $productIds = Wishlist::where('app_user_id', $_COOKIE['app_user_id'])
            ->select('product_id')
            ->get();

        if (count($productIds) >= 1) {
            $products = Product::with(['productDescription'])->whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $product->image = ImageLinkManager::getImageUrl($product->image, 'small');
            }
        }

        return view('front.wishlist.wishlist-modal', compact('products'));
    }
}
