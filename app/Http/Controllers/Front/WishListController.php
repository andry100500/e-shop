<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Images\ImageLinkManager;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use phpDocumentor\Reflection\Types\Null_;

class WishListController extends Controller
{
    public function index()
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

        $breadcrumbs[] = [
            'ancor' => Lang::get('wishlist.h1')];

        return view('front.wishlist.wishlist-page-layout', compact('products','breadcrumbs'));
    }
}
