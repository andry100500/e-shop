<?php
namespace App\Http\Services;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ProductController;

use App\Models\Url;

class ControllerManager
{
    public function run()
    {
        $url = UrlManager::getUrl();

        if (substr($url, -1) === '/'){
            $category = new CategoryController();
            return $category->show($url);
        }else{
            $product = new ProductController();
            return $product->show($url);
        }
    }

}
