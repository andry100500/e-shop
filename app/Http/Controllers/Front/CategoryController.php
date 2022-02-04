<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Breadcrumbs\CategoryBreadcrumbs;
use App\Http\Services\Images\ImageLinkManager;
use App\Http\Services\SubCategoriesManager;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{

    public function show($url)
    {

        $category = Category::with([
            'categoryDescription',
            'parentCategories',
            'subCategories',
            'firstChildCategories',
            'firstChildCategories.categoryDescription'
        ])->where('url', $url)->first();
        foreach ($category->firstChildCategories as $firstChildCategory){
            if ($firstChildCategory->image){
                $firstChildCategory->image = ImageLinkManager::getImageUrl($firstChildCategory->image, 'category_subcategories_menu');
            }
        }
        $breadcrumbs = CategoryBreadcrumbs::getBreadcrumbs($category);

        $categoriesIds = SubCategoriesManager::getSubcategoriesIds($category);

        switch (request()->sort) {
            case 'name_asc':
                $order = ['by' => 'price', 'direction' => 'asc'];
                break;
            default:
                $order = ['by' => 'sort_order', 'direction' => 'asc'];
        }

        $products = Product::with(['productDescription'])
            ->whereIn('category_id', $categoriesIds)
            ->orderBy($order['by'], $order['direction'])
            ->paginate(15);

        foreach ($products as $product) {
            if ($product->image){
                $product->image = ImageLinkManager::getImageUrl($product->image, 'middle');
            }
        }

        return view('front.catalog.category', compact('category', 'breadcrumbs', 'products'));

    }
}
