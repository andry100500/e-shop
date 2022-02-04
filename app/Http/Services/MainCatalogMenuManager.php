<?php


namespace App\Http\Services;



use App\Http\Services\Images\ImageLinkManager;
use App\Models\Category;

class MainCatalogMenuManager
{
    /**
     * Возвращает список категорий для галвного меню
     * TODO настроить кеширование
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getMainMenu()
    {
        $categories = Category::with(['categoryDescription', 'subCategory', 'subCategory.categoryDescription'])
            ->where(['status' => 1, 'category_id' => 0])
            ->get();

        foreach ($categories as $category) {
            $category->image = ImageLinkManager::getImageUrl($category->image, 'category_header_menu');

            if ($category->subCategory){
                foreach ($category->subCategory as $subCategory){
                    $subCategory->image = ImageLinkManager::getImageUrl($subCategory->image, 'category_header_menu');
                }
            }
        }

        return $categories;

    }
}
