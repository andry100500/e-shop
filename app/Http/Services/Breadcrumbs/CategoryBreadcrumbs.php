<?php


namespace App\Http\Services\Breadcrumbs;

use App\Http\Services\LangFieldNameManager;
use App\Models\Url;
use Illuminate\Database\Eloquent\Model;

class CategoryBreadcrumbs
{
    public static $breadcrumbs = [];

    public static function getBreadcrumbs($currentCategory)
    {
        self::getParents($currentCategory);

        $ids = array_column(self::$breadcrumbs, 'id');
        $urls = Url::whereIn('element_id', $ids)
            ->where('page_type', 'category')
            ->select('url', 'element_id')
            ->get();

        self::bindUrls($urls);
        return self::rebuildBreadcrumbs();
    }

    /**
     * Рекурсивная функция, принимает текущую категорию, ложит ее и все родительские в массив с крошками
     * @param $currentCategory
     */
    private static function getParents($currentCategory)
    {
        // ложим текущую категорию в массив с крошками
        self::$breadcrumbs[] = ['id' => $currentCategory->id,
            'ancor' => $currentCategory->categoryDescription->name];

        if ($currentCategory->parentCategories) {
            self::getParents($currentCategory->parentCategories);
        }
    }

    /**
     * Принимает массив уролов категорий и прикрепляет их к соответсвующим категориям в массиве с крошками
     * @param $urls
     */
    private static function bindUrls($urls)
    {
        foreach ($urls as $url) {
            foreach (self::$breadcrumbs as $key => $breadcrumb) {
                if ($breadcrumb['id'] == $url->element_id) {
                    self::$breadcrumbs[$key]['url'] = $url->url;
                }
            }
        }
    }

    /**
     * Метод сортирует хлебные крошки в правильном порядке
     * @return array
     */
    private static function rebuildBreadcrumbs()
    {
        $noRebuildedBreadcrumbs = self::$breadcrumbs;

        $rebuildedBreadcrumbs = [];
        for ($i = count($noRebuildedBreadcrumbs) - 1; $i >= 0; $i--) {
            $rebuildedBreadcrumbs[] = $noRebuildedBreadcrumbs[$i];
        }

        return $rebuildedBreadcrumbs;
    }
}
