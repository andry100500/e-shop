<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Images\ImageLinkManager;
use App\Http\Services\UrlManager;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['postsDescription'])
            ->where('status', 1)->paginate(15);
        foreach ($posts as $post) {
            $post->image = ImageLinkManager::getImageUrl($post->image, 'blod_preview');
        }
        $breadcrumbs[] = [
            'ancor' => Lang::get('blog.h1')];

        return view('front.blog.index', compact('posts', 'breadcrumbs'));
    }

    public function show()
    {
        $url = UrlManager::getUrl();
        $post = Post::with(['postsDescription'])
            ->where('url', $url)->first();
        $post->image = ImageLinkManager::getImageUrl($post->image, 'blod_main_mage');

        $breadcrumbs[] = [
            'ancor' => $post->postsDescription->name];

        return view('front.blog.show', compact('post', 'breadcrumbs'));
    }
}
