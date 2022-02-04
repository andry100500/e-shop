<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class OrderController extends Controller
{
    public function orderDone()
    {
        $breadcrumbs[] = [
            'ancor' => Lang::get('thank-you-page.h1')];
        return view('front.pages.thank-you-page', compact('breadcrumbs'));
    }
}
