<?php


namespace App\Http\Services;


class SubCategoriesManager
{

    public static $ids = [];


    public static function getSubcategoriesIds($currentCategory)
    {
        self::$ids[] = $currentCategory->id;  // ложим в массив id текущей категории
        self::appendSubCategoriesIds($currentCategory);
        return self::$ids;
    }


    private static function appendSubCategoriesIds($currentCategory)
    {
        if (count($currentCategory->subCategories) > 0) {
            foreach ($currentCategory->subCategories as $subCategory){
                self::$ids [] = $subCategory->id;
                if (count($subCategory->subCategories) > 0){
                    self::appendSubCategoriesIds($subCategory);
                }
            }
        }
    }

}
