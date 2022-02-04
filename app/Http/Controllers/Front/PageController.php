<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\UrlManager;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show()
    {
        $url = UrlManager::getUrl();
        $page = Page::with('pageDescription')
            ->where('url', $url)
            ->first();


        $breadcrumbs[] = [
            'ancor' => $page->pageDescription->name];



        return view('front.pages.info-page', compact('page', 'breadcrumbs'));
    }
}
