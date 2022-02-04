<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Breadcrumbs\ProductBreadcrumbs;
use App\Http\Services\Images\ImageLinkManager;
use App\Http\Services\LangLinkManager;
use App\Models\Product;
use App\Models\Redirect;
use App\Models\Review;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * @param $url
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($url)
    {
        $product = Product::with([
            'productDescription',
            'category',
            'characteristicProduct',
            'characteristicProduct.characteristic',
            'characteristicProduct.characteristic.characteristicDescriptions',
            'reviews',
            'productImages'
        ])->where([
            'url' => $url,
            'status' => 1
        ])->first();


        if (!$product){
            $redirect = Redirect::where('from', $_SERVER['REQUEST_URI'])->firstOrFail();
            return header("Location: $redirect->to");
        }

        $product->mainImage = ImageLinkManager::getImageUrl($product->image, 'big');
        $product->bigImage = ImageLinkManager::getImageUrl($product->image, 'bigest');


        // формируем массив урлов дополнительных картинок
        if ($product->productImages) {

            for ($i = 0; $i < count($product->productImages); $i++) {
                $additionImages[$i]['small'] = ImageLinkManager::getImageUrl($product->productImages[$i]['image'], 'small');
                $additionImages[$i]['big'] = ImageLinkManager::getImageUrl($product->productImages[$i]['image'], 'big');
                $additionImages[$i]['bigest'] = ImageLinkManager::getImageUrl($product->productImages[$i]['image'], 'bigest');
            }

        }


        $breadcrumbs = ProductBreadcrumbs::get($product);

        return view('front.catalog.product', compact('product', 'breadcrumbs', 'additionImages'));
    }


    public function storeReview(Request $request)
    {
        $review = new Review();

        $review->status = 0;
        $review->product_id = $request->product_id;
        $review->name = $request->name;
        $review->text = $request->text;
        $review->pluses = $request->pluses;
        $review->minuses = $request->minuses;
        $review->rating = 5;
        $review->save();
        return redirect()->back()->with('success', 'Success');
    }
}
