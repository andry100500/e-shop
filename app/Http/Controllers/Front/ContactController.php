<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ContactController extends Controller
{
    public function index()
    {
        $breadcrumbs[] = [
            'ancor' => Lang::get('contacts.h1')];
        return view('front.pages.contacts', compact('breadcrumbs'));
    }
}
