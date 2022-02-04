<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\ControllerManager;
use App\Http\Services\UrlManager;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brandsSource = Brand::orderBy('name', 'asc')->get();

        $brands = [];

        foreach ($brandsSource as $brandSource) {
            $letter = mb_strtoupper(substr($brandSource->name, 0, 1));
            $brands [$letter][] = ['name' => $brandSource->name, 'url' => $brandSource->url];
        }
        return view('front.brands.index', compact('brands'));
    }

    public function show()
    {

        $url = UrlManager::getUrl();

        $brand = Brand::with(['brandDescription'])
            ->where('url', $url)
            ->firstOrFail();

        $products = Product::with('productDescription')
            ->where(['brand_id' => $brand->id, 'status'=> 1])
            ->paginate(15);

        return view('front.brands.show', compact('brand', 'products'));
    }
}
