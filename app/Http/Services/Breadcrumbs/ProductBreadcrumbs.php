<?php


namespace App\Http\Services\Breadcrumbs;


use App\Http\Services\LangFieldNameManager;
use App\Models\Url;

class ProductBreadcrumbs
{
    public static function get($product)
    {
       // $breadcrumbs = CategoryBreadcrumbs::getBreadcrumbs($product->category, 'parentCategories', 'category'); // TODO - удалиь строку, если все5 ок. Спустя время обнаружил лишние аргументы функции.
        $breadcrumbs = CategoryBreadcrumbs::getBreadcrumbs($product->category);

        array_push($breadcrumbs, [
            'ancor' => $product->productDescription->name,
            'url' => Url::where('page_type', 'product')->where('element_id', $product->id)->first()->url]
        );

        return $breadcrumbs;
    }
}
