<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    public function index()
    {
        $breadcrumbs[] = [
            'ancor' => Lang::get('login.h1')];
        return view('front.pages.login', compact('breadcrumbs'));
    }
}
