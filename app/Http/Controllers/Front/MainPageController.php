<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Images\ImageLinkManager;
use App\Http\Services\MenuManager;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        $page = Page::where('url', '/')->with('pageDescription')->first();

        $orderProducts = OrderProduct::limit(10)->orderBy('order_id', 'desc')->select('product_id')->get();

        $popularProducts = [];
        foreach ($orderProducts as $orderProduct ){
            $popularProducts[] = $orderProduct->product_id;
        }


        $popularProducts = Product::with('productDescription')
            ->whereIn('id',$popularProducts)
            ->select(['id', 'url', 'image', 'price'])
            ->get();


        foreach ($popularProducts as $product){
            $product->image = ImageLinkManager::getImageUrl($product->image, 'middle');
        }

        $latestPosts = Post::where('status', 1)->orderBy('id', 'desc')->limit(4)->with('postsDescription')->get();
        foreach ($latestPosts as $post){
            $post->image = ImageLinkManager::getImageUrl($post->image, 'blod_preview');
            $post->postsDescription->description = mb_substr($post->postsDescription->description,0,10);
        }

        $catalogMenuLiks = MenuManager::getMenu('main_page_menu');

        return view('front.pages.main-page', compact('page','popularProducts', 'latestPosts', 'catalogMenuLiks'));
    }
}
