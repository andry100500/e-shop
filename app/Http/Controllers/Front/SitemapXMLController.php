<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\UrlManager;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapXMLController extends Controller
{

    public function index()
    {
        $domain = UrlManager::getDomain();
        return response()
            ->view('front.robot-sitemap.index', compact('domain'))
            ->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $domain = UrlManager::getDomain();
        $categories = Category::where('status', 1)->get();
        return response()
            ->view('front.robot-sitemap.categories', compact('categories', 'domain'))
            ->header('Content-Type', 'text/xml');
    }

    public function products()
    {
        $domain = UrlManager::getDomain();
        $products = Product::where('status', 1)->get();
        return response()
            ->view('front.robot-sitemap.products', compact('products', 'domain'))
            ->header('Content-Type', 'text/xml');
    }

    public function blog()
    {
        $domain = UrlManager::getDomain();
        $posts = Post::where('status', 1)->get();
        return response()
            ->view('front.robot-sitemap.blog', compact('posts', 'domain'))
            ->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        $domain = UrlManager::getDomain();
        $pages = Post::where('status', 1)->get();
        return response()
            ->view('front.robot-sitemap.pages', compact('pages', 'domain'))
            ->header('Content-Type', 'text/xml');
    }

}
