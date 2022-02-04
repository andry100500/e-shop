<?php

namespace App\Http\Services;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;

class LangLinkManager
{
    /**
     * Возвращает итоговый url учитывая префикс для текущего языка
     * @param $url
     * @return mixed|string
     */
    public static function current($url)
    {
        if (App::getLocale() === 'ua') {
            return $url;
        } else {
            return '/ru' . $url;
        }
    }

    /**
     * Возвращает аналог текущей страницы, но на другом языке
     * @return array|mixed|string|string[]
     */
    public static function other()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        if (App::getLocale() === 'ua') {
            return '/ru' . $currentPage;
        } else {
            return str_replace('/ru/', '/', $currentPage);
        }
    }


    /**
     * Возвращает ссылки на языковые версии для rell alternate
     * @return array
     */
    public static function getRellAlternateLinks()
    {
        $links = [];
        if (App::getLocale() === 'ua'){
            $links['uk'] = UrlManager::getDomain() . self::current($_SERVER['REQUEST_URI']);
            $links['ru'] = UrlManager::getDomain() . self::other();
        }else{
            $links['uk'] = UrlManager::getDomain() . self::other();
            $links['ru'] = UrlManager::getDomain() . $_SERVER['REQUEST_URI'];
        }
        return $links;
    }

    // Возвращает url текущей языковой версии для редиректа средствами js
    public function getRedirectUrl()
    {
        $currentPath = $_GET['current-path'];
        $neededUrl =  $_GET['need'];
        $currentPathArr = explode('/', $currentPath);

        if ($currentPathArr[1] === 'ru'){
            App::setLocale('ru');
        }
        else{
            App::setLocale('ua');
        }

       return self::current($neededUrl);
    }
}
