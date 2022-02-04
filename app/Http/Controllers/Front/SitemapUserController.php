<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SitemapUserController extends Controller
{
    public function show()
    {
        $categories = Category::with(['subCategories'])
            ->where(['category_id' => 0, 'status' => 1])
            ->orderBy('sort_order', 'asc')
            ->get();

        $pages = Page::with('pageDescription')
            ->where(['status'=>1])
            ->get();

        $posts = Post::with('postsDescription')
            ->where(['status' => 1])
            ->orderBy('sort_order', 'asc')
            ->get();

        $breadcrumbs[] = [
            'ancor' => Lang::get('sitemap.h1')];

        return view('front.pages.sitemap-user', compact('categories', 'pages', 'posts', 'breadcrumbs'));
    }
}
